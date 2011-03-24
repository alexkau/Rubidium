<?php /* Smarty version Smarty-3.0.6, created on 2011-03-13 14:19:55
         compiled from "/htdocs/rubidium/templates/modules/admin/sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10214466534d7d34fb446ae5-62474003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31634a00329800a277989f259b6b019d6abdd88d' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/sidebar.tpl',
      1 => 1300051059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10214466534d7d34fb446ae5-62474003',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_php')) include '/htdocs/rubidium/3rdparty/smarty/plugins/block.php.php';
if (!is_callable('smarty_function_sidebarRegexString')) include '/htdocs/rubidium/3rdparty/smarty/plugins/function.sidebarRegexString.php';
?><ul id='sidebar'>
	<?php  $_smarty_tpl->tpl_vars['sectionInfo'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('loadInfo')->value['sidebar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sectionInfo']->key => $_smarty_tpl->tpl_vars['sectionInfo']->value){
 $_smarty_tpl->tpl_vars['section']->value = $_smarty_tpl->tpl_vars['sectionInfo']->key;
?>
		<li class='section'>
			<?php echo $_smarty_tpl->tpl_vars['section']->value;?>

		</li>
		<?php  $_smarty_tpl->tpl_vars['urlInfo'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['urlName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sectionInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['urlInfo']->key => $_smarty_tpl->tpl_vars['urlInfo']->value){
 $_smarty_tpl->tpl_vars['urlName']->value = $_smarty_tpl->tpl_vars['urlInfo']->key;
?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; smarty_block_php(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

//				preg_match('/^[^&]+/', $loadInfo['sidebar']['General']['Settings'], $matches);
//				$smarty->assign('currentSection' , $matches[0]);
//				$currentSection = $matches[0];
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_php(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			<?php ob_start(); ?><?php echo smarty_function_sidebarRegexString(array('urlInfo'=>$_smarty_tpl->tpl_vars['urlInfo']->value),$_smarty_tpl);?>
<?php  $_smarty_tpl->assign('urlString', ob_get_contents()); Smarty::$_smarty_vars['capture']['default']=ob_get_clean();?>
			<li class='sectionLink<?php if ($_smarty_tpl->getVariable('loadInfo')->value['section']==$_smarty_tpl->getVariable('urlString')->value){?> selected<?php }?>'>
				<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=admin&module=<?php echo $_smarty_tpl->getVariable('loadInfo')->value['module'];?>
&section=<?php echo $_smarty_tpl->tpl_vars['urlInfo']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['urlName']->value;?>
</a>
			</li>
		<?php }} ?>
	<?php }} ?>
</ul>
