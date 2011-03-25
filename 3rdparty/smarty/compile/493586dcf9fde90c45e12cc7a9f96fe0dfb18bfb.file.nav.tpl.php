<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 22:06:12
         compiled from "/htdocs/rubidium/templates/core/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14296205164d8c22c485e6a9-58850848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '493586dcf9fde90c45e12cc7a9f96fe0dfb18bfb' => 
    array (
      0 => '/htdocs/rubidium/templates/core/nav.tpl',
      1 => 1300826801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14296205164d8c22c485e6a9-58850848',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id='nav'>
	<ul>
		<?php  $_smarty_tpl->tpl_vars['content'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('navbar')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['content']->key => $_smarty_tpl->tpl_vars['content']->value){
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['content']->key;
?>
			<li<?php if ($_smarty_tpl->tpl_vars['content']->value['regex']!=''&&preg_match($_smarty_tpl->tpl_vars['content']->value['regex'],$_SERVER['REQUEST_URI'])){?> class='selected'<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['content']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['content']->value['title'];?>
</a></li>
		<?php }} ?>
	</ul>
</div>