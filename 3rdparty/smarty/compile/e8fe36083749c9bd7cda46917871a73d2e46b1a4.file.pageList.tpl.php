<?php /* Smarty version Smarty-3.0.6, created on 2011-03-12 13:57:46
         compiled from "/var/www/rubidium/templates/modules/page/admin/pageList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20414755854d7bec5ae2a762-60161209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8fe36083749c9bd7cda46917871a73d2e46b1a4' => 
    array (
      0 => '/var/www/rubidium/templates/modules/page/admin/pageList.tpl',
      1 => 1299959658,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20414755854d7bec5ae2a762-60161209',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
