<div id='nav'>
	<ul>
		{foreach $navbar as $id=>$content}
			<li{if $content.regex != '' && preg_match($content.regex, $smarty.server.REQUEST_URI)} class='selected'{/if}><a href="{$content.url}">{$content.title}</a></li>
		{/foreach}
	</ul>
</div>