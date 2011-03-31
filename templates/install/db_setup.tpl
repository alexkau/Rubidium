<p class='message'>This step will set up the database.<br /><br />If you are unsure of any of these values, contact your webhost for assistance.</p>
<form action='install.php?step=config' method='post'>
	<label for='sql_user'>MySQL user</label><input type='text' name='sql_user' /><br />
	<label for='sql_password'>MySQL password</label><input type='password' name='sql_password' /><br />
	<label for='sql_server'>MySQL server location</label><input type='text' name='sql_server' value='localhost' /><br />
	<label for='sql_database'>MySQL database</label><input type='text' name='sql_database' /><br />
	<input type='submit' class='button' value='Continue' />
</form>