{if $loadInfo.deletedPage}
	<p class='message'>The page was successfully deleted.</p>
{/if}
{if $loadInfo.cantDelete404}
	<p class='message error'>Error: You can't delete the 404 page.</p>
{/if}
<a class='button' href='index.php?mode=admin&module=page&add=true'>Add page</a>
<ul id='pageList'>
{foreach $loadInfo.pageList as $id => $data}
	<li>
		<a href='index.php?mode=admin&module=page&section=manage&edit={$id}'>{$data.title}</a>
	</li>
{/foreach}
</ul>
