{include file="`$smarty.const.ROOT_PATH`templates/modules/admin/inlinehelp.tpl" message="This page lists all of your installed modules.<br />To edit a module's information, click on its name.<br />To install a new module, click 'Install new module' after uploading its files."}
<ul class='textLinkList'>
	{foreach $loadInfo.fullModuleList as $name => $data}
		<li>
			<a href='index.php?mode=admin&module=admin&section=modules&edit={$data.numeric_id}'>{$data.name}</a>
		</li>
	{/foreach}
</ul>
<a class='button ' href='index.php?mode=admin&module=admin&section=modules&install=true'>Install new module</a>
