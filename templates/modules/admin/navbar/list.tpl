{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="This page lets you manage the items in the navigation bar.<br />Click on an item to edit it, or click the 'Add item' button to add a new item.<br />To rearrange the items, click and drag on the icon to the left of an item."}
{if $loadInfo.deletedItem}
	<p class='message'>The item was successfully deleted.</p>
{/if}
<div id='hidden' class='hide'></div>
<ul id='navsort' class='sortable'>
	{foreach $navbar as $id=>$content}
		<li id='list_{$content.id}'>
			<span><img class='handle' src='images/arrow_out.png' alt='' /><a href="index.php?mode=admin&module=admin&section=navbar&edit={$content.id}">{$content.title}</a></span>
		</li>
	{/foreach}
</ul>
<a class='button' href='index.php?mode=admin&module=admin&section=navbar&add=true'>Add item</a>
