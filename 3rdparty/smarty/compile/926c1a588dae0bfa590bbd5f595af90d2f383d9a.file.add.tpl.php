<?php /* Smarty version Smarty-3.0.6, created on 2011-03-13 14:20:00
         compiled from "/htdocs/rubidium/templates/modules/page/admin/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20523391594d7d3500d8cb04-51481943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '926c1a588dae0bfa590bbd5f595af90d2f383d9a' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/page/admin/add.tpl',
      1 => 1300051059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20523391594d7d3500d8cb04-51481943',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['changesMade']){?>
	<p class='message'>
		The page was successfully added.<br />
		You can view it at <a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=page&id=<?php echo $_smarty_tpl->getVariable('loadInfo')->value['newPageId'];?>
"><?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=page&id=<?php echo $_smarty_tpl->getVariable('loadInfo')->value['newPageId'];?>
</a>.
	</p>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/page/admin/pageList.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }else{ ?>
	<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
	Title: <input type="text" name="pageTitle"></input>
	<textarea class="editor" name="pageContent"></textarea>
	<input type="submit" class='button' value="Add page" />
	<input type="hidden" value="addPage" name="action" />
	</form>
<?php }?>
