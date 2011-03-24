<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 12:00:01
         compiled from "/htdocs/rubidium/templates/modules/admin/navbarlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:52563574d8b94b174d395-34392290%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd04a1eb70c822fdae72d81cc972ca2aa5300c4a8' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/navbarlist.tpl',
      1 => 1300993174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52563574d8b94b174d395-34392290',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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