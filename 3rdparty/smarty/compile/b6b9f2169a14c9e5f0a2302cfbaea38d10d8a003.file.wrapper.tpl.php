<?php /* Smarty version Smarty-3.0.6, created on 2011-01-09 20:11:28
         compiled from "/var/www/rubidium/admin/../3rdparty/smarty/templates/wrapper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6830319604d2a86f0b0cef3-14706879%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6b9f2169a14c9e5f0a2302cfbaea38d10d8a003' => 
    array (
      0 => '/var/www/rubidium/admin/../3rdparty/smarty/templates/wrapper.tpl',
      1 => 1294632540,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6830319604d2a86f0b0cef3-14706879',
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
</head>
<body>
	<div id='wrapper'>
		<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('toLoad')->value['mode']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	</div>
</body>
</html>
