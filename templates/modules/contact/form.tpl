<div id='content'>
	{if $loadInfo.error}
	<p class='message error'>
		{$loadInfo.error}
	</p>
	{/if}
	<form action='index.php?mode=contact&submit=true' method='post' id='contactform'>
	<ul class='textInputList'>
		<li><span>Subject</span><input type='text' name='subject' class='required' /></li>
		<li><span>Return address</span><input type='text' name='return_addr' class='required' /></li>
		<li><span>Message</span><textarea rows='10' cols='50' name='message' class='required'></textarea></li>
		<li><span></span>{$loadInfo.recaptcha}</li>
		<li><span></span><input type='submit' class='button' value='Send message' /></li>
	</ul>
	</form>
</div>
