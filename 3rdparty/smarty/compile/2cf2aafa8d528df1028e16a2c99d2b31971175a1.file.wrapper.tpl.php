<?php /* Smarty version Smarty-3.0.6, created on 2011-03-22 13:31:48
         compiled from "/htdocs/rubidium/templates/core/wrapper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19103754464d890734969974-65822809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2cf2aafa8d528df1028e16a2c99d2b31971175a1' => 
    array (
      0 => '/htdocs/rubidium/templates/core/wrapper.tpl',
      1 => 1300824378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19103754464d890734969974-65822809',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE HTML>		
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<title><?php echo $_smarty_tpl->getVariable('loadInfo')->value['title'];?>
</title>
	<link rel='stylesheet' href='<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/css/main.css' type='text/css' />
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/jsinclude.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</head>
<body>
<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<div id='wrapper'>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/".($_smarty_tpl->getVariable('loadInfo')->value['templateCategory'])."/".($_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	</div>
	
</body>
</html>
