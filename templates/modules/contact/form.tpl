<div id='content'>
	{if $loadInfo.error}
	<p class='message error'>
		{$loadInfo.error}
	</p>
	{/if}
	<form action='index.php?mode=contact&submit=true' method='post' id='contactform'>
		<label class='left' for='title'>Subject</label><input type='text' name='subject' class='required' /><br />
		<label class='left' for='return_addr'>Return address</label><input type='text' name='return_addr' class='required' /><br />
		<label class='left' for='message'>Message</label><textarea rows='10' cols='50' name='message' class='required'></textarea>
		{$loadInfo.recaptcha}
		<label class='left'></label><input type='submit' class='button' value='Send message' />
	</form>
</div>
