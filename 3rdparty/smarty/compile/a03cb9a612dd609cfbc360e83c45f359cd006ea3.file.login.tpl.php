<?php /* Smarty version Smarty-3.0.6, created on 2011-03-11 19:17:12
         compiled from "/var/www/rubidium/templates/modules/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13752898154d7ae5b8ab20b0-76162999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a03cb9a612dd609cfbc360e83c45f359cd006ea3' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/login.tpl',
      1 => 1299899773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13752898154d7ae5b8ab20b0-76162999',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id='content'>
	<?php if ($_smarty_tpl->getVariable('loadInfo')->value['loginfailed']){?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/loginfailed.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<?php }elseif($_smarty_tpl->getVariable('loadInfo')->value['timeout']){?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/timeout.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<?php }?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/loginbox.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
