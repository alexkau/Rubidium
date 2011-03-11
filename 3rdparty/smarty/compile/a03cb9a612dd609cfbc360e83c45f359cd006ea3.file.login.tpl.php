<?php /* Smarty version Smarty-3.0.6, created on 2011-03-10 17:40:00
         compiled from "/var/www/rubidium/templates/modules/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14741924124d797d7056c8b0-62195790%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a03cb9a612dd609cfbc360e83c45f359cd006ea3' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/login.tpl',
      1 => 1299807585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14741924124d797d7056c8b0-62195790',
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
