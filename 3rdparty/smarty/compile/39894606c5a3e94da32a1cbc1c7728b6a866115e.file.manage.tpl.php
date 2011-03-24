<?php /* Smarty version Smarty-3.0.6, created on 2011-03-13 14:19:59
         compiled from "/htdocs/rubidium/templates/modules/page/admin/manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1144315514d7d34ff6b9290-55117653%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39894606c5a3e94da32a1cbc1c7728b6a866115e' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/page/admin/manage.tpl',
      1 => 1300051059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1144315514d7d34ff6b9290-55117653',
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
