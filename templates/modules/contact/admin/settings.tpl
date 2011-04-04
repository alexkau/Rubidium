<h2>Contact Form Settings</h2>
{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="From here, you can change the settings for the contact form module.<br />Emails sent using the form will be directed to the contact email specified here.<br />You should not need to change either of the reCaptcha key values; these settings are provided for advanced users only."}
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
<ul class='textInputList'>
	<span>Contact email</span><input class='wide' type="text" name="email" value='{$settings.contact_email.value}' /><br />
	<span>reCaptcha public key</span><input class='wide' type="text" name="public_key" value='{$settings.recaptcha_public_key.value}' /><br />
	<span>reCaptcha private key</span><input class='wide' type="text" name="private_key" value='{$settings.recaptcha_private_key.value}' /><br />
	<input type='submit' class='primary button' value='Change settings' />
</ul>
</form>
