		<div id='header'>
			<h1>Rubidium Admin CP</h1>
			<div id='topright'>
				<span id='index'>
					<a href="{$config.base_url}/index.php">Site Index</a>
				</span>
				{if $loadInfo.authorized && $loadInfo.templateToLoad != 'logout'}
					<span id='logout'>
						|&nbsp;<a href="{$config.base_url}/index.php?mode=admin&module=admin&section=logout">Log out</a>
					</span>
				{/if}
			</div>
		</div>
