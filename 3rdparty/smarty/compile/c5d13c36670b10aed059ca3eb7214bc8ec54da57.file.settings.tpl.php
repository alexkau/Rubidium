<?php /* Smarty version Smarty-3.0.6, created on 2011-03-13 12:16:54
         compiled from "/var/www/rubidium/templates/modules/page/admin/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15645053564d7d1826d07425-97512268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5d13c36670b10aed059ca3eb7214bc8ec54da57' => 
    array (
      0 => '/var/www/rubidium/templates/modules/page/admin/settings.tpl',
      1 => 1300043813,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15645053564d7d1826d07425-97512268',
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
	<ul>
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
