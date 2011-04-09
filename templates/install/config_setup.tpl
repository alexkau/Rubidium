<p class='message'>Successfully connected to the database.<br /><br />Please enter the following configuration values.</p>
<form action='install.php?step=install' method='post'>
<ul class='textInputList'>
	<li><span>Administrator password</span><input type='password' name='admin_password' class='wide' /></li>
	<li><span>Site URL</span><input type='text' name='site_url' value='{$loadInfo.siteUrl}' class='wide' /></li>
	<li><span>Site Title</span><input type='text' name='site_title' class='wide' /></li>
	<li><span>Contact email</span><input type='text' name='contact_email' class='wide' /></li>
	<input type='hidden' name='sql_user' value='{$smarty.post.sql_user}' />
	<input type='hidden' name='sql_password' value='{$smarty.post.sql_password}' />
	<input type='hidden' name='sql_server' value='{$smarty.post.sql_server}' />
	<input type='hidden' name='sql_database' value='{$smarty.post.sql_database}' />
	<li><span></span><input type='submit' class='button' value='Continue' /></li>
</ul>
</form>