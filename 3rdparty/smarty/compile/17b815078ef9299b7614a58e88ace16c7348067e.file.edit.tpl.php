<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 13:35:13
         compiled from "/htdocs/rubidium/templates/modules/page/admin/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12596176824d8bab0197ca18-41979933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17b815078ef9299b7614a58e88ace16c7348067e' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/page/admin/edit.tpl',
      1 => 1300995893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12596176824d8bab0197ca18-41979933',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['changesMade']){?>
	<p class='message'>Your changes were successfully made.</p>
<?php }?>
Title: <input type="text" name="pageTitle" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['pageEditInfo']['title'];?>
"></input>
<textarea class="editor" name="pageContent"><?php echo $_smarty_tpl->getVariable('loadInfo')->value['pageEditInfo']['content'];?>
</textarea>
<input type="submit" class='button' value="Save changes" />
<a class='button negative' onclick="javascript:confirmDelete('<?php echo $_SERVER['REQUEST_URI'];?>
&delete=true')">Delete page</a>
<input type="hidden" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['pageEditInfo']['id'];?>
" name="id" />
<input type="hidden" value="editPage" name="action" />
</form>
