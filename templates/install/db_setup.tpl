<p class='message'>This step will set up the database.<br /><br />If you are unsure of any of these values, contact your webhost for assistance.</p>
<form action='install.php?step=config' method='post'>
<ul class='textInputList'>
	<li><span>MySQL user</span><input type='text' name='sql_user' /></li>
	<li><span>MySQL password</span><input type='password' name='sql_password' /></li>
	<li><span>MySQL server location</span><input type='text' name='sql_server' value='localhost' /></li>
	<li><span>MySQL database</span><input type='text' name='sql_database' /><br /></li>
	<li><span></span><input type='submit' class='button' value='Continue' /></li>
</form>