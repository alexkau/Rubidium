<?php /* Smarty version Smarty-3.0.6, created on 2011-03-11 22:33:41
         compiled from "/var/www/rubidium/templates/modules/page/admin/manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6662434354d7b13c581b956-08497308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0141bc1f0182a8e85a7f7aefaadf726d634a6db4' => 
    array (
      0 => '/var/www/rubidium/templates/modules/page/admin/manage.tpl',
      1 => 1299911620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6662434354d7b13c581b956-08497308',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Manage Pages

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
