<?php /* Smarty version Smarty-3.0.6, created on 2011-03-12 17:24:04
         compiled from "/var/www/rubidium/templates/modules/page/admin/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20297093994d7c1cb4e62ab0-10280516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc9bd397b12b900269cf410430a270ed042678f8' => 
    array (
      0 => '/var/www/rubidium/templates/modules/page/admin/add.tpl',
      1 => 1299979225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20297093994d7c1cb4e62ab0-10280516',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['changesMade']){?>
	<p class='message'>
	<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>

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
