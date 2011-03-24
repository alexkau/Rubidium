<?php /* Smarty version Smarty-3.0.6, created on 2011-03-13 14:18:00
         compiled from "/htdocs/rubidium/templates/modules/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20716990594d7d348802e154-53134824%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b6a2f092d0d323ee32bc184a5ab1ff0b46716cb' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/login.tpl',
      1 => 1300051059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20716990594d7d348802e154-53134824',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['loginfailed']){?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/loginfailed.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }elseif($_smarty_tpl->getVariable('loadInfo')->value['timeout']){?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/timeout.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/loginbox.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
