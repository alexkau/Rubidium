<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 13:00:39
         compiled from "/htdocs/rubidium/templates/modules/admin/navbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15032810524d8ba2e739d774-43023833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4dbd6d50492c61731bf0f22ddcdf027aff81058f' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/navbar.tpl',
      1 => 1300996837,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15032810524d8ba2e739d774-43023833',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Manage Navigation Bar</h2>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['error']){?>
	<p class='message error'>
		There was an error in making the change: <?php echo $_smarty_tpl->getVariable('loadInfo')->value['error'];?>

	</p>
<?php }?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['subsection']){?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/navbar/".($_smarty_tpl->getVariable('loadInfo')->value['subsection']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }else{ ?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/navbar/list.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
