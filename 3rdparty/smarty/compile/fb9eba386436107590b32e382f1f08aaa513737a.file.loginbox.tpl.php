<?php /* Smarty version Smarty-3.0.6, created on 2011-03-10 17:40:00
         compiled from "/var/www/rubidium/templates/modules/admin/login/loginbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20837662484d797d705b2be0-55788090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb9eba386436107590b32e382f1f08aaa513737a' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/login/loginbox.tpl',
      1 => 1299807594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20837662484d797d705b2be0-55788090',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="index.php?mode=admin&module=admin&section=login" method="post">
Password: <input type="password" name="password" /><br />
<input type="submit" value="Login" />
</form>
