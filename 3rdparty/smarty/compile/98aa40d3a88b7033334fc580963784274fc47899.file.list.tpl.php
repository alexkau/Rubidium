<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 13:13:56
         compiled from "/htdocs/rubidium/templates/modules/admin/navbar/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5766853344d8ba6047b6b11-97993545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98aa40d3a88b7033334fc580963784274fc47899' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/navbar/list.tpl',
      1 => 1300997634,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5766853344d8ba6047b6b11-97993545',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['deletedItem']){?>
	<p class='message'>The item was successfully deleted.</p>
<?php }?>
<a class='button' href='index.php?mode=admin&module=admin&section=navbar&add=true'>Add item</a>
<div id='hidden' class='hide'></div>
<ul id='navsort' class='sortable'>
	<?php  $_smarty_tpl->tpl_vars['content'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('navbar')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['content']->key => $_smarty_tpl->tpl_vars['content']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['content']->key;
?>
		<li id='list_<?php echo $_smarty_tpl->tpl_vars['content']->value['id'];?>
'>
			<span><img class='handle' src='images/arrow_out.png' alt='' /><a href="index.php?mode=admin&module=admin&section=navbar&edit=<?php echo $_smarty_tpl->tpl_vars['content']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['content']->value['title'];?>
</a></span>
		</li>
	<?php }} ?>
</ul>