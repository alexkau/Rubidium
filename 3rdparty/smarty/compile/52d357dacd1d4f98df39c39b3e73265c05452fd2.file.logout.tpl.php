<?php /* Smarty version Smarty-3.0.6, created on 2011-03-14 10:05:33
         compiled from "/htdocs/rubidium/templates/modules/admin/logout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18857673654d7e4add181e58-44106721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52d357dacd1d4f98df39c39b3e73265c05452fd2' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/logout.tpl',
      1 => 1300051059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18857673654d7e4add181e58-44106721',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
You have been logged out.<br />
<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=admin&module=admin&section=login">Login again</a><br />
<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
">Index page</a>
