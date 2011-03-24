<div id='nav'>
	<ul>
		{foreach $modules as $id=>$content}
			<li{if $loadInfo.module == $id} class='selected'{/if}><a href="index.php?mode=admin&module={$id}">{$content.name}</a></li>
		{/foreach}
	</ul>
</div>