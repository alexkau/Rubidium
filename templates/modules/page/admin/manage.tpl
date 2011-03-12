Manage Pages

<ul id='pageList'>
{foreach $loadInfo.pageList as $id => $data}
	<li>
		<a href='index.php?mode=admin&module=page&section=manage&edit={$id}'>{$data.title}</a>
	</li>
{/foreach}
</ul>
