<div id='content'>
	{if $loadInfo.error}
	<p class='message error'>
		{$loadInfo.error}
	</p>
	{/if}
	<form action='index.php?mode=contact&submit=true' method='post' id='contactform'>
		<label for='title'>Subject</label><input type='text' name='subject' class='required' /><br />
		<label for='return_addr'>Return address</label><input type='text' name='return_addr' class='required' /><br />
		<label for='message'>Message</label><textarea rows='10' cols='50' name='message' class='required'></textarea>
		{$loadInfo.recaptcha}
		<label></label><input type='submit' class='button' value='Send message' />
	</form>
</div>