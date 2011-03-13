<?php /* Smarty version Smarty-3.0.6, created on 2011-03-13 11:27:47
         compiled from "/var/www/rubidium/templates/modules/admin/logout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18768482084d7d0ca3be71a6-98714929%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '521c4b54e7d548a08eb1ddbfc9eaea18d5e73c99' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/logout.tpl',
      1 => 1299906444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18768482084d7d0ca3be71a6-98714929',
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
