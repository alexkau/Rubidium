<ul id='sidebar'>
	{foreach $loadInfo.sidebar as $section=>$sectionInfo}
		<li class='section'>
			{$section}
		</li>
		{foreach $sectionInfo as $urlName=>$urlInfo}
			{php}
//				preg_match('/^[^&]+/', $loadInfo['sidebar']['General']['Settings'], $matches);
//				$smarty->assign('currentSection' , $matches[0]);
//				$currentSection = $matches[0];
			{/php}
			{capture assign=urlString}{sidebarRegexString urlInfo=$urlInfo}{/capture}
			<li class='sectionLink{if $loadInfo.section == $urlString} selected{/if}'>
				<a href="{$config.base_url}/index.php?mode=admin&module={$loadInfo.module}&section={$urlInfo}">{$urlName}</a>
			</li>
		{/foreach}
	{/foreach}
</ul>
