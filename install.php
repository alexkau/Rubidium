<?php
define("PRINT_FILENAMES",0);
rubidiumInstall::execute();

class rubidiumInstall {
	static public $post		= null;
	static public $get		= null;
	static public $toDisplay	= null;
	static public $action		= null;
	static public $error		= null;
	static public $database		= null;
	static public $siteUrl		= null;
	
	function execute() {
		define('ROOT_PATH', dirname( __FILE__ ) . '/');
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
					self::$toDisplay = "<p class='message'>Congratulations! You have successfully installed Rubidium.<br /><br /><a href='" . rubidium::$config['base_url'] . "'>Click here</a> to visit your website, or <a href='" . rubidium::$config['base_url'] . "/index.php?mode=admin'>click here</a> to access the administrator control panel.</p>";
					break;
				case 'config':
					if (self::validateSqlConn()) {
						self::$toDisplay = "<p class='message'>Successfully connected to the database.<br /><br />Please enter the following configuration values.</p>
									<form action='install.php?step=install' method='post'>
										<label for='admin_password'>Administrator password</label><input type='password' name='admin_password' class='wide' /><br />
										<label for='site_url'>Site URL</label><input type='text' name='site_url' value='" . self::$siteUrl . "' class='wide' /><br />
										<!-- Include autodetected url here at some point -->
										<label for='site_title'>Site Title</label><input type='text' name='site_title' class='wide' /><br />
										<label for='contact_email'>Contact email</label><input type='text' name='contact_email' class='wide' /><br />
										<input type='hidden' name='sql_user' value='" . self::$post['sql_user'] . "' />
										<input type='hidden' name='sql_password' value='" . self::$post['sql_password'] . "' />
										<input type='hidden' name='sql_server' value='" . self::$post['sql_server'] . "' />
										<input type='hidden' name='sql_database' value='" . self::$post['sql_database'] . "' />
										<input type='submit' class='button' value='Continue' />
									</form>
								";
					} else if (self::$error == 'db_login_failed') {
						self::$toDisplay = "<p class='message error'>Could not connect to the MySQL server with the specified username and password.</p>";
					} else if (self::$error == 'db_select_failed') {
						self::$toDisplay = "<p class='message error'>Could not select the specified database.</p>";
					} else {
						self::$toDisplay = "<p class='message error'>An unknown error occurred while connecting to the database.</p>";
					}
					break;
				case 'db':
					self::$toDisplay = 	"<p class='message'>This step will set up the database.<br /><br />If you are unsure of any of these values, contact your webhost for assistance.</p>
									<form action='install.php?step=config' method='post'>
										<label for='sql_user'>MySQL user</label><input type='text' name='sql_user' /><br />
										<label for='sql_password'>MySQL password</label><input type='password' name='sql_password' /><br />
										<label for='sql_server'>MySQL server location</label><input type='text' name='sql_server' value='localhost' /><br />
										<label for='sql_database'>MySQL database</label><input type='text' name='sql_database' /><br />
										<input type='submit' class='button' value='Continue' />
									</form>
								";
					break;
				default:
					if ($baseconfig['sql_user'] != '' && self::$get['force'] != 'true') {
						self::$toDisplay = 	"<p class='message error'>The installer has detected that you already have a copy of Rubidium installed in this location. Are you sure you want to overwrite it?</p>
									If so, <a href='install.php?force=true'>click here to continue</a>.";
					} else {
						self::$toDisplay = "<p class='message'>Welcome to the Rubidium installer.<br /><br />This script will install Rubidium on your web server. <a href='install.php?step=db'>Click here</a> to continue.</p>";
					}
					break;
			}
		} else {
			self::$toDisplay = "<p class='message error'>The installer is currently locked due to a previous installation. If you want to proceed, you must delete the file \"installer_lock\" to unlock the installer.</p>";
		}
		
		self::displayPage();
	}
	
	function displayPage() {
		echo "
			
			<!DOCTYPE HTML>		
			<html> 
			<head> 
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'> 
				<title>Index Page</title> 
				<link rel='stylesheet' href='http://localhost/rubidium/css/main.css' type='text/css' /> 
			</head> 
			<body> 
			<div id='header'> 
				<h1>Rubidium Installer</h1> 
			</div>
			<div id='wrapper'> 
				<div id='content'>
					" . self::$toDisplay . "
				</div>
			</div>	
			</body> 
			</html>";
	}
	
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
	
	function doInstall() {		
$configfile = 
"<?php
\$baseconfig['sql_user']		= '" . self::$post['sql_user'] . "';
\$baseconfig['sql_password']	= '" . self::$post['sql_password'] . "';
\$baseconfig['sql_server']	= '" . self::$post['sql_server'] . "';
\$baseconfig['sql_database']	= '" . self::$post['sql_database'] . "';
\$baseconfig['base_url']		= '" . self::$post['site_url'] . "';

/* Defines the debug level
 * 0 = No messages displayed
 * 1 = Most messages displayed
 * 2 = All messages displayed, including those with private info:
 *     This level should NOT be used on live sites.
 *     Debug level 1 has not been implemented yet;
 *     either level will display all messages.
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
		
		classDB::$database->query("
		INSERT INTO `navbar` (`id`, `position`, `url`, `title`, `regex`) VALUES
			(1, 0, '" . self::$siteUrl . "', 'Index', '/(?!index)|(mode=page&id=1)/i');");
		
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
			(2, 'footer', 'Global site footer', 'Powered by Rubidium'),
			(5, '404_page', 'ID of page to display on 404 error', '2'),
			(4, 'default_mode', 'Default mode to load if not specified', 'page'),
			(7, 'recaptcha_public_key', 'reCaptcha public key', '6Le77sISAAAAAImz59nMZPQJNqeSU3O6kduZ3KyC'),
			(8, 'recaptcha_private_key', 'reCaptcha private key', '6Le77sISAAAAAKDDS37FXdDMqopZgvEhAL1ItCA1'),
			(9, 'contact_email', 'Contact email', '" . self::$post['contact_email'] . "'),
			(10, 'site_title', 'Global title for the site', '" . self::$post['site_title'] . "');");

		classDB::close();
	}
	
	function generateSalt() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';
		for ($p = 0; $p < 16; $p++) {
			$string .= substr($characters, mt_rand(0, 35), 1);
		}
		return $string;
	}
	
	function setPassword($password) {
		$salt = self::generateSalt();
		$hash = hash("sha512", $password.$salt);
		classDB::insert('admin_info', array('value' => $salt, 'name' => 'password_salt'));
		classDB::insert('admin_info', array('value' => $hash, 'name' => 'password_hash'));
	}

}

?>