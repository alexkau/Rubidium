<p class='message'>Successfully connected to the database.<br /><br />Please enter the following configuration values.</p>
<form action='install.php?step=install' method='post'>
	<label for='admin_password'>Administrator password</label><input type='password' name='admin_password' class='wide' /><br />
	<label for='site_url'>Site URL</label><input type='text' name='site_url' value='{$loadInfo.siteUrl}' class='wide' /><br />
	<!-- Include autodetected url here at some point -->
	<label for='site_title'>Site Title</label><input type='text' name='site_title' class='wide' /><br />
	<label for='contact_email'>Contact email</label><input type='text' name='contact_email' class='wide' /><br />
	<input type='hidden' name='sql_user' value='{$smarty.post.sql_user}' />
	<input type='hidden' name='sql_password' value='{$smarty.post.sql_password}' />
	<input type='hidden' name='sql_server' value='{$smarty.post.sql_server}' />
	<input type='hidden' name='sql_database' value='{$smarty.post.sql_database}' />
	<input type='submit' class='button' value='Continue' />
</form>