<?php /* Smarty version Smarty-3.0.6, created on 2011-03-12 16:35:20
         compiled from "/var/www/rubidium/templates/modules/page/admin/manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21210651304d7c1148a92849-91266774%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0141bc1f0182a8e85a7f7aefaadf726d634a6db4' => 
    array (
      0 => '/var/www/rubidium/templates/modules/page/admin/manage.tpl',
      1 => 1299976515,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21210651304d7c1148a92849-91266774',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Manage Pages</h2>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['subsection']){?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/page/admin/".($_smarty_tpl->getVariable('loadInfo')->value['subsection']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }else{ ?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/page/admin/pageList.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
