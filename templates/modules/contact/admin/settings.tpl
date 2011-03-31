<h2>Contact Form Settings</h2>
{if $loadInfo.changesMade}
	<p class='message'>
		The change was successfully made.
	</p>
{else if $loadInfo.error}
	<p class='message error'>
		There was an error in making the change: {$loadInfo.error}
	</p>
{/if}
<form action="{$smarty.server.REQUEST_URI}" method="post">
	<label for='email'>Contact email</label><input class='wide' type="text" name="email" value='{$settings.contact_email.value}' /><br />
	<label for='public_key'>reCaptcha public key</label><input class='wide' type="text" name="public_key" value='{$settings.recaptcha_public_key.value}' /><br />
	<label for='private_key'>reCaptcha private key</label><input class='wide' type="text" name="private_key" value='{$settings.recaptcha_private_key.value}' /><br />
	<input type='submit' class='primary button' value='Change settings' />
</form>