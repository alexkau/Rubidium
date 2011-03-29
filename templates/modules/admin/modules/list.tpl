<ul>
	{foreach $loadInfo.fullModuleList as $name => $data}
		<li>
			<a href='index.php?mode=admin&module=admin&section=modules&edit={$data.numeric_id}'>{$data.name}</a>
		</li>
	{/foreach}
</ul>
<a class='button' href='index.php?mode=admin&module=admin&section=modules&install=true'>Install new module</a>