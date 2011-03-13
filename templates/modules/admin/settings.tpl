<h2>System Settings</h2>
{if $loadInfo.changesMade}
	<p class='message'>
		The change was successfully made.
	</p>
{else if $loadInfo.error}
	<p class='message error'>
		There was an error in making the change: {$loadInfo.error}
	</p>
{/if}
<span>Change administrator password:</span><br />
<form action="{$smarty.server.REQUEST_URI}" method="post">
<span class='indent'>Old password:</span><input type="password" name="oldpassword" /><br />
<span class='indent'>New password:</span><input type="password" name="newpassword1" /><br />
<span class='indent'>Confirm new password:</span><input type="password" name="newpassword2" /><br />
<input type='submit' class='primary button' value='Change password' />
</form>
