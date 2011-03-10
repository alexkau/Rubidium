<?php /* Smarty version Smarty-3.0.6, created on 2011-03-10 14:09:24
         compiled from "/htdocs/rubidium/templates/modules/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10432868694d794c14c14c72-00426203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b6a2f092d0d323ee32bc184a5ab1ff0b46716cb' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/login.tpl',
      1 => 1299794959,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10432868694d794c14c14c72-00426203',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id='content'>
	<?php if ($_smarty_tpl->getVariable('loadInfo')->value['loginfailed']){?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/loginfailed.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<?php }?>
	<?php if ($_smarty_tpl->getVariable('loadInfo')->value['loginsuccessful']){?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/loginsuccessful.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<meta http-equiv='refresh' content='2; url=<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=admin&module=admin&section=index' /> 
	<?php }else{ ?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/login/loginbox.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<?php }?>
</div>
