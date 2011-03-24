<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 12:57:20
         compiled from "/htdocs/rubidium/templates/modules/admin/navbar/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14116051864d8ba2206c60d3-94499699%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9781fc0b919878231d8bc756d261278b3dd0980' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/navbar/add.tpl',
      1 => 1300996465,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14116051864d8ba2206c60d3-94499699',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['changesMade']){?>
	<p class='message'>
		The navbar item was successfully added.
	</p>
	<?php $_template = new Smarty_Internal_Template((@ROOT_PATH)."templates/modules/admin/navbar/list.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }else{ ?>
	<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
	<ul class='textInputList'>
		<li><span>Title</span><input type="text" name="itemTitle"></input></li>
		<li><span>URL</span><input type="text" name="itemUrl"></input></li>
		<li><span>Regex to match (optional)</span><input type="text" name="itemRegex"></input></li>
	</ul>
	<input type="submit" class='button' value="Add item" />
	<input type="hidden" value="addItem" name="action" />
	</form>
<?php }?>