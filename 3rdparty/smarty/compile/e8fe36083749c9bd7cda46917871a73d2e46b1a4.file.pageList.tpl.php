<?php /* Smarty version Smarty-3.0.6, created on 2011-03-12 19:11:02
         compiled from "/var/www/rubidium/templates/modules/page/admin/pageList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20965855524d7c35c62c6215-10572576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8fe36083749c9bd7cda46917871a73d2e46b1a4' => 
    array (
      0 => '/var/www/rubidium/templates/modules/page/admin/pageList.tpl',
      1 => 1299985860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20965855524d7c35c62c6215-10572576',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['deletedPage']){?>
	<p class='message'>The page was successfully deleted.</p>
<?php }?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['cantDelete404']){?>
	<p class='message error'>Error: You can't delete the 404 page.</p>
<?php }?>
<a class='button' href='index.php?mode=admin&module=page&add=true'>Add page</a>
<ul id='pageList'>
<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('loadInfo')->value['pageList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['data']->key;
?>
	<li>
		<a href='index.php?mode=admin&module=page&section=manage&edit=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</a>
	</li>
<?php }} ?>
</ul>
