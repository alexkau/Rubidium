<ul>
	{foreach $modules as $name => $data}
		<li>
			<a href='index.php?mode=admin&module=admin&section=modules&edit={$data.numeric_id}'>{$data.name}</a>
		</li>
	{/foreach}
</ul>