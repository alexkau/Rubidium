<?php /* Smarty version Smarty-3.0.6, created on 2011-03-22 13:11:06
         compiled from "/htdocs/rubidium/templates/modules/admin/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14543138734d89025a0b7c22-28838540%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baed66d966f981419fb055c833619252e46dfcf4' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/nav.tpl',
      1 => 1300824663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14543138734d89025a0b7c22-28838540',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id='nav'>
	<ul>
		<?php  $_smarty_tpl->tpl_vars['content'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modules')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['content']->key => $_smarty_tpl->tpl_vars['content']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['content']->key;
?>
			<li<?php if ($_smarty_tpl->getVariable('loadInfo')->value['module']==$_smarty_tpl->tpl_vars['id']->value){?> class='selected'<?php }?>><a href="index.php?mode=admin&module=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['content']->value['name'];?>
</a></li>
		<?php }} ?>
	</ul>
</div>