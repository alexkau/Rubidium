<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 13:25:36
         compiled from "/htdocs/rubidium/templates/modules/page/admin/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1512059554d8ba8c0e69a48-00394656%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3811fb33fcb224596460a348c10b8c2c56669768' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/page/admin/settings.tpl',
      1 => 1300998335,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1512059554d8ba8c0e69a48-00394656',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Settings</h2>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['changesMade']){?>
	<p class='message'>
		The change was successfully made.
	</p>
<?php }?>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
	<ul class='textInputList'>
		<li><span>Change default page</span>
			<select name="default">
				<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('loadInfo')->value['pageList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['data']->key;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['id']->value==$_smarty_tpl->getVariable('modules')->value['page']['default_action_value']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</option>
				<?php }} ?>
			</select>
		</li>
		<li><span>Change 404 page</span>
			<select name="404">
				<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('loadInfo')->value['pageList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['data']->key;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['id']->value==$_smarty_tpl->getVariable('settings')->value['404_page']['value']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</option>
				<?php }} ?>
			</select>
		</li>
	</ul>
	<input type='submit' class='primary button' value='Save changes'></input>
</form>
