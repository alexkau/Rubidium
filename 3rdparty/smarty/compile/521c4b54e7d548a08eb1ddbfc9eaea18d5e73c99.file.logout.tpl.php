<?php /* Smarty version Smarty-3.0.6, created on 2011-03-10 17:53:18
         compiled from "/var/www/rubidium/templates/modules/admin/logout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3078591874d79808eaaf003-04297756%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '521c4b54e7d548a08eb1ddbfc9eaea18d5e73c99' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/logout.tpl',
      1 => 1299808398,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3078591874d79808eaaf003-04297756',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id='content'>
	You have been logged out.<br />
	<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=admin&module=admin&section=login">Login again</a><br />
	<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
">Index page</a>
</div>
