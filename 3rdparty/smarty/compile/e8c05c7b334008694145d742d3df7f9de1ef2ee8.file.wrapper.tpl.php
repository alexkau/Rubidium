<?php /* Smarty version Smarty-3.0.6, created on 2011-03-12 13:57:44
         compiled from "/var/www/rubidium/templates/modules/admin/wrapper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13488352814d7bec58738c49-53788807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8c05c7b334008694145d742d3df7f9de1ef2ee8' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/wrapper.tpl',
      1 => 1299967024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13488352814d7bec58738c49-53788807',
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
<br />
<br />
<br />
<br />
<br />
<br />
	<div id='wrapper'<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?> class='narrow'<?php }?>>
		<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
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
