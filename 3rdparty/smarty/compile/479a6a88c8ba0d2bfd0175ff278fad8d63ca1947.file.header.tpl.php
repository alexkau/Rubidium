<?php /* Smarty version Smarty-3.0.6, created on 2011-03-11 20:43:06
         compiled from "/var/www/rubidium/templates/modules/admin/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16267308254d7af9da84b038-29945662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '479a6a88c8ba0d2bfd0175ff278fad8d63ca1947' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/header.tpl',
      1 => 1299904985,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16267308254d7af9da84b038-29945662',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
		<div id='header'>
			<h1>Rubidium Admin CP</h1>
			<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?>
				<span id='logout' class='right'>
					<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=admin&module=admin&section=logout">Log out</a>
				</span><br />
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
			<?php }?>
		</div>
