		<div id='header'>
			<h1 style='float: left'>Rubidium Admin CP</h1>
			{if $loadInfo.authorized && $loadInfo.templateToLoad != 'logout'}
				<span class='right'>
					<a href="{$config.base_url}/index.php?mode=admin&module=admin&section=logout">Log out</a>
				</span><br />
			{/if}
			<ul style='display: block; clear:both'><li>Placeholder for header links</li></ul>
		</div>
