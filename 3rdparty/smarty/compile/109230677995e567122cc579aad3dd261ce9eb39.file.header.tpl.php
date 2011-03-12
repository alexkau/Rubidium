<?php /* Smarty version Smarty-3.0.6, created on 2011-03-10 18:57:53
         compiled from "/htdocs/rubidium/templates/modules/admin/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3599323504d798fb18bf2a0-46955833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '109230677995e567122cc579aad3dd261ce9eb39' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/header.tpl',
      1 => 1299812271,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3599323504d798fb18bf2a0-46955833',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
		<div id='header'>
			<h1>Rubidium Admin CP</h1>
			<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?>
				<span class='right'>
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
					<li><a href="index.php?mode=admin&module=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['content']->value['name'];?>
</a></li>
				<?php }} ?>
			</ul>
			<?php }?>
		</div>
