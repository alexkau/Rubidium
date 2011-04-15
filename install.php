<?php
/**
 * Installer
 * @package rubidium 
 */

rubidiumInstall::execute();

/**
 * Installer
 * @author alex
 * @package rubidium
 */
class rubidiumInstall {
	static public $post		= null;
	static public $get		= null;
	static public $toDisplay	= null;
	static public $action		= null;
	static public $error		= null;
	static public $database		= null;
	static public $siteUrl		= null;
	static public $loadInfo		= null;
	
	/**
	 * Determines which step to run and does it
	 */
	function execute() {
		define('ROOT_PATH', dirname( __FILE__ ) . '/');
		define('SMARTY_DIR', dirname( __FILE__ ) . '/3rdparty/smarty/');
		require('config.php');
		require('sources/core.php');
		require('sources/debug.php');
		require('sources/db.php');
		rubidium::getRequest();
		self::$post = rubidium::$request['POST'];
		self::$get = rubidium::$request['GET'];

		$siteUrlTemp = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
		self::$siteUrl = preg_replace('/\/install.php?(.*)/i', '', $siteUrlTemp);

		if (self::$get['step'] != '') {
			self::$action = self::$get['step'];
		}
		
		if (!file_exists('installer_lock')) {
			switch (self::$action){
				case 'install':
					self::doInstall();
					$lock = fopen(installer_lock, 'w');
					fclose($lock);
					self::$loadInfo['config'] = $baseconfig;
					self::$loadInfo['template'] = 'install_successful';
					break;
				case 'config':
					if (self::validateSqlConn()) {
						self::$loadInfo['template'] = 'config_setup';
						self::$loadInfo['siteUrl'] = self::$siteUrl;						
					} else if (self::$error == 'db_login_failed') {
						self::$loadInfo['template'] = 'mysql_conn_failed';
					} else if (self::$error == 'db_select_failed') {
						self::$loadInfo['template'] = 'mysql_select_failed';
					} else {
						self::$loadInfo['template'] = 'mysql_unknown_error';
					}
					break;
				case 'db':
					self::$loadInfo['template'] = 'db_setup';
					break;
				default:
					if ($baseconfig['sql_user'] != '' && self::$get['force'] != 'true') {
						self::$loadInfo['template'] = 'confirm_overwrite';
					} else {
						self::$loadInfo['template'] = 'landing';
					}
					break;
			}
		} else {
			self::$loadInfo['template'] = 'installer_locked';
		}
		
		self::displayPage();
	}
	
	/**
	 * Loads Smarty, sets variables, displays the page
	 */
	function displayPage() {
		require(SMARTY_DIR . 'Smarty.class.php');
		$smarty = new Smarty();
		$smarty->setTemplateDir	(ROOT_PATH . 'templates');
		$smarty->setCompileDir	(SMARTY_DIR . 'compile');
		$smarty->setCacheDir	(SMARTY_DIR . 'cache');
		$smarty->setConfigDir	(SMARTY_DIR . 'config');
		$smarty->assign		('config', rubidium::$config);
		$smarty->assign		('loadInfo', self::$loadInfo);
		$smarty->display	('install/wrapper.tpl');
	}
	
	/**
	 * Checks whether the database connection is valid
	 * Returns an error if appropriate
	 * @return boolean
	 */
	function validateSqlConn() {
		self::$database = new mysqli(self::$post['sql_server'],self::$post['sql_user'],self::$post['sql_password']);
		if (mysqli_connect_errno()) {
			self::$error = 'db_login_failed';
			return false;
		} else if (self::$database->select_db(self::$post['sql_database'])) {
			return true;
		} else {
			self::$error = 'db_select_failed';
			return false;
		}
	}
	
	/**
	 * Writes config file, creates and populates database
	 */
	function doInstall() {		
$configfile = 
"<?php
\$baseconfig['sql_user']		= '" . self::$post['sql_user'] . "';
\$baseconfig['sql_password']	= '" . self::$post['sql_password'] . "';
\$baseconfig['sql_server']	= '" . self::$post['sql_server'] . "';
\$baseconfig['sql_database']	= '" . self::$post['sql_database'] . "';
\$baseconfig['base_url']		= '" . self::$post['site_url'] . "';

/**
 * Defines the debug level
 * 0 = No messages displayed
 * 1 = Display debug messages (only for development/testing)
 */
define('DEBUG',0);";
file_put_contents(ROOT_PATH . 'config.php', $configfile);

		rubidium::loadConfig();
		classDB::connect();
		classDB::$database->query("
		CREATE TABLE `admin_info` ( 	`name` text NOT NULL,
						`value` text NOT NULL ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		
		self::setPassword(self::$post['admin_password']);
		
		classDB::$database->query("
		INSERT INTO `admin_info` (`name`, `value`) VALUES
			('login_key', ''),
			('timeout_time', '');");

		
		classDB::$database->query("
		CREATE TABLE `modules` (	`numeric_id` int(11) NOT NULL AUTO_INCREMENT,
						`id` varchar(32) NOT NULL,
						`name` varchar(32) NOT NULL,
						`default_action` varchar(32) NOT NULL,
						`default_action_value` varchar(32) NOT NULL,
						`enabled` tinyint(1) NOT NULL,
						`protected` tinyint(1) NOT NULL,
						PRIMARY KEY (`numeric_id`) )
						ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

		classDB::$database->query("
		INSERT INTO `modules` (`numeric_id`, `id`, `name`, `default_action`, `default_action_value`, `enabled`, `protected`) VALUES
			(2, 'page', 'Pages', 'id', '1', 1, 1),
			(1, 'admin', 'Dashboard', 'module', 'dashboard', 1, 1);");

		
		classDB::createSectionsTable('admin');
		classDB::createSectionsTable('page');
		
		classDB::$database->query("
		CREATE TABLE `module_page_pages` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`title` varchar(256) NOT NULL,
			`content` text NOT NULL,
			`last_updated` int(11) NOT NULL,
			PRIMARY KEY (`id`) )
			ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
		
		classDB::$database->query("
		INSERT INTO `module_admin_sections` (`name`, `public_name`, `pageInfo`) VALUES
			('index', 'Index', 'title=Admin+CP+Dashboard&templateCategory=modules%2Fadmin&templateToLoad=dashboard'),
			('login', 'Log in', 'title=Admin+CP+Login&templateCategory=modules%2Fadmin&templateToLoad=login'),
			('logout', 'Log out', 'title=Logged+Out&templateCategory=modules%2Fadmin&templateToLoad=logout'),
			('settings', 'Settings', 'title=Settings&templateCategory=modules%2Fadmin&templateToLoad=settings'),
			('navbar', 'Navigation Bar', 'title=Navigation%20Bar&templateCategory=modules%2Fadmin&templateToLoad=navbar'),
			('modules', 'Modules', 'title=Modules&templateCategory=modules%2Fadmin&templateToLoad=modules');");
		
		classDB::$database->query("
		INSERT INTO `module_page_sections` (`name`, `public_name`, `pageInfo`) VALUES
			('index', 'Index', 'title=Page Manager&templateCategory=modules%2Fpage%2Fadmin&templateToLoad=index'),
			('manage', 'Manage Pages', 'title=Manage Pages&templateCategory=modules%2Fpage%2Fadmin&templateToLoad=manage'),
			('settings', 'Settings', 'title=Settings&templateCategory=modules%2Fpage%2Fadmin&templateToLoad=settings');");

		
		classDB::$database->query("
		INSERT INTO `module_page_pages` (`id`, `title`, `content`, `last_updated`) VALUES
			(1, 'Index Page', '<p>This is the default Rubidium index page. Open up the Admin CP and visit the Pages tab to change the content here!</p>', '" . time() . "'),
			(2, '404 Error', '<p>Error 404 - the requested page was not found.</p>', '" . time() . "');");

		
		classDB::$database->query("
		CREATE TABLE `navbar` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
 			`position` int(11) NOT NULL,
			`url` text NOT NULL,
			`title` text NOT NULL,
			`regex` text NOT NULL,
			PRIMARY KEY (`id`) )
			ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
		
		
		$sitePath = preg_replace('/\/install.php?(.*)/i', '', substr($_SERVER['REQUEST_URI'], 1));
		classDB::$database->query("
		INSERT INTO `navbar` (`id`, `position`, `url`, `title`, `regex`) VALUES
			(1, 0, '" . self::$siteUrl . "', 'Index', '/(" . $sitePath . "\/\(?!index))|(mode=page&id=1)|(index.php(?!.))/i');");
		
		classDB::$database->query("
		CREATE TABLE `settings` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(256) NOT NULL,
			`description` varchar(256) NOT NULL,
			`value` text NOT NULL,
			PRIMARY KEY (`id`) )
			ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
		
		classDB::$database->query("
		INSERT INTO `settings` (`id`, `name`, `description`, `value`) VALUES
			(1, 'footer', 'Global site footer', 'Powered by Rubidium'),
			(2, '404_page', 'ID of page to display on 404 error', '2'),
			(3, 'default_mode', 'Default mode to load if not specified', 'page'),
			(4, 'recaptcha_public_key', 'reCaptcha public key', '6Le77sISAAAAAImz59nMZPQJNqeSU3O6kduZ3KyC'),
			(5, 'recaptcha_private_key', 'reCaptcha private key', '6Le77sISAAAAAKDDS37FXdDMqopZgvEhAL1ItCA1'),
			(6, 'contact_email', 'Contact email', '" . self::$post['contact_email'] . "'),
			(7, 'site_title', 'Global title for the site', '" . self::$post['site_title'] . "'),
			(8, 'useInlineHelp', 'Bool - Show ACP inline help?', '1');");

		classDB::close();
	}
	
	/**
	 * Generates a random 16-character string to be used as a password salt 
	 * @return string
	 */
	function generateSalt() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';
		for ($p = 0; $p < 16; $p++) {
			$string .= substr($characters, mt_rand(0, 35), 1);
		}
		return $string;
	}
	
	/**
	 * Generates a password salt, SHA-512 hashes it against the password, and sets the admin password and salt
	 * @param unknown_type $password
	 */
	function setPassword($password) {
		$salt = self::generateSalt();
		$hash = hash("sha512", $password.$salt);
		classDB::insert('admin_info', array('value' => $salt, 'name' => 'password_salt'));
		classDB::insert('admin_info', array('value' => $hash, 'name' => 'password_hash'));
	}

}

?>
