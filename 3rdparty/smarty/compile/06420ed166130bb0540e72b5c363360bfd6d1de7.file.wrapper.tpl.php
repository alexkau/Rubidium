<?php /* Smarty version Smarty-3.0.6, created on 2011-01-09 20:09:21
         compiled from "/var/www/rubidium/3rdparty/smarty/templates/wrapper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16063111854d2a8671a03160-09165691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06420ed166130bb0540e72b5c363360bfd6d1de7' => 
    array (
      0 => '/var/www/rubidium/3rdparty/smarty/templates/wrapper.tpl',
      1 => 1294632540,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16063111854d2a8671a03160-09165691',
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
