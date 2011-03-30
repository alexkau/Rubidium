<?php

rubidiumInstall::execute();

class rubidiumInstall {
	static public $post		= null;
	static public $get		= null;
	static public $toDisplay	= null;
	static public $action		= null;
	
	function execute() {
		self::$post = $_POST;
		self::$get = $_GET;
		require('config.php');
		
		if (self::$get['step'] != '') {
			self::$action = self::$get['step'];
		}
		
		switch (self::$action){
			case 'config':
				self::$toDisplay = 'Nope';
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
}

?>
