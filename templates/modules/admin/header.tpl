		<div id='header'>
			<h1>Rubidium Admin CP</h1>
			{if $loadInfo.authorized && $loadInfo.templateToLoad != 'logout'}
				<span class='right'>
					<a href="{$config.base_url}/index.php?mode=admin&module=admin&section=logout">Log out</a>
				</span><br />
			<ul>
				{foreach $modules as $id=>$content}
					<li><a href="index.php?mode=admin&module={$id}">{$content.name}</a></li>
				{/foreach}
			</ul>
			{/if}
		</div>
