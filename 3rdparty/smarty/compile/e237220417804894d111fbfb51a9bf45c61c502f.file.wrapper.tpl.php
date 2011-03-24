<?php /* Smarty version Smarty-3.0.6, created on 2011-03-22 13:08:23
         compiled from "/htdocs/rubidium/templates/modules/admin/wrapper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16731249794d8901b71e2227-80463611%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e237220417804894d111fbfb51a9bf45c61c502f' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/wrapper.tpl',
      1 => 1300824501,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16731249794d8901b71e2227-80463611',
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
	<link rel='stylesheet' href='<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/css/admin.css' type='text/css' />
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/jsinclude.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</head>
<body>
<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
	<div id='wrapper'<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?> class='narrow'<?php }?>>
		<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?>
			<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/sidebar.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<?php }?>
		<div id='content'>
			<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/".($_smarty_tpl->getVariable('loadInfo')->value['templateCategory'])."/".($_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		</div>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/core/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	</div>
	
</body>
</html>
