{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="This is a list of all of the pages on your website.<br />Click on a page to edit it, or click the 'Add Page' button to create a new page."}
{if $loadInfo.deletedPage}
	<p class='message'>The page was successfully deleted.</p>
{/if}
{if $loadInfo.cantDelete404}
	<p class='message error'>Error: You can't delete the 404 page.</p>
{/if}
{if $loadInfo.cantDeleteIndex}
	<p class='message error'>Error: You can't delete the index page.</p>
{/if}
<ul id='pageList' class='textLinkList'>
{foreach $loadInfo.pageList as $id => $data}
	<li>
		<a href='index.php?mode=admin&module=page&section=manage&edit={$id}'>{$data.title}</a>
	</li>
{/foreach}
</ul>
<a class='button' href='index.php?mode=admin&module=page&add=true'>Add page</a>
