<?php /* Smarty version Smarty-3.0.6, created on 2011-03-12 14:05:10
         compiled from "/var/www/rubidium/templates/modules/page/admin/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5419721884d7bee1635c090-13108021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4e536e4a5406fc70f2bcf98f65a31d92ac84293' => 
    array (
      0 => '/var/www/rubidium/templates/modules/page/admin/edit.tpl',
      1 => 1299967508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5419721884d7bee1635c090-13108021',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
Title: <input type="text" name="pageTitle" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['pageEditInfo']['title'];?>
"></input>
<textarea class="editor" name="pageContent"><?php echo $_smarty_tpl->getVariable('loadInfo')->value['pageEditInfo']['content'];?>
</textarea>
<input type="submit" class='button' value="Save changes" />
<input type="hidden" value="<?php echo $_smarty_tpl->getVariable('loadInfo')->value['pageEditInfo']['id'];?>
" name="id" />
<input type="hidden" value="editPage" name="action" />
</form>
