<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 12:51:48
         compiled from "/htdocs/rubidium/templates/modules/admin/navbar/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1794138794d8ba0d46c9534-64426216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '243ed4f90a97bf20edc6d112d5e94571d62932bf' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/navbar/edit.tpl',
      1 => 1300996283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1794138794d8ba0d46c9534-64426216',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
<ul class='textInputList'>
	<li><span>Title</span><input type="text" name="itemTitle" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['itemEditInfo']['title'];?>
"></input></li>
	<li><span>URL</span><input type="text" name="itemUrl" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['itemEditInfo']['url'];?>
"></input></li>
	<li><span>Regex to match (optional)</span><input type="text" name="itemRegex" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['itemEditInfo']['regex'];?>
"></input></li>
</ul>
<input type="submit" class='button' value="Save changes" />
<a class='button negative' onclick="javascript:confirmDeleteItem('<?php echo $_SERVER['REQUEST_URI'];?>
&delete=true')">Delete item</a>
<input type="hidden" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['itemEditInfo']['id'];?>
" name="id" />
<input type="hidden" value="editItem" name="action" />
</form>