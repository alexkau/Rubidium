<?php /* Smarty version Smarty-3.0.6, created on 2011-03-11 19:20:04
         compiled from "/var/www/rubidium/templates/core/wrapper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13673435344d6b1a02971da2-94427225%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75acc48772562a63598a7a9453d7158c16a98902' => 
    array (
      0 => '/var/www/rubidium/templates/core/wrapper.tpl',
      1 => 1299730591,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13673435344d6b1a02971da2-94427225',
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
<br />
<br />
<hr />
Break here because of Chrome's autocomplete URL bar T__T
<hr />
<br />
<br />
	<div id='wrapper'>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/".($_smarty_tpl->getVariable('loadInfo')->value['templateCategory'])."/".($_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	</div>
	
</body>
</html>
