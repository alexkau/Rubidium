<?php /* Smarty version Smarty-3.0.6, created on 2011-03-10 18:25:26
         compiled from "/htdocs/rubidium/templates/modules/admin/login/loginbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16697763964d798816c1f619-87403194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36961eacb31f5b27f187482917d0eac056ebd878' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/login/loginbox.tpl',
      1 => 1299810281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16697763964d798816c1f619-87403194',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="index.php?mode=admin&module=admin&section=login" method="post">
Password: <input type="password" name="password" /><br />
<input type="submit" value="Login" />
</form>
