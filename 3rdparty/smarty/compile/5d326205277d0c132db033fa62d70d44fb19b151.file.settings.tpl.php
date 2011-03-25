<?php /* Smarty version Smarty-3.0.6, created on 2011-03-24 14:17:42
         compiled from "/htdocs/rubidium/templates/modules/admin/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19828635214d8bb4f62afbc6-92806056%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d326205277d0c132db033fa62d70d44fb19b151' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/settings.tpl',
      1 => 1301001461,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19828635214d8bb4f62afbc6-92806056',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>System Settings</h2>
<?php if ($_smarty_tpl->getVariable('loadInfo')->value['changesMade']){?>
	<p class='message'>
		The change was successfully made.
	</p>
<?php }elseif($_smarty_tpl->getVariable('loadInfo')->value['error']){?>
	<p class='message error'>
		There was an error in making the change: <?php echo $_smarty_tpl->getVariable('loadInfo')->value['error'];?>

	</p>
<?php }?>
<span>Change administrator password:</span><br />
<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
	<ul class='textInputList'>
		<li><span>Old password:</span><input type="password" name="oldpassword" /><br />
		<li><span>New password:</span><input type="password" name="newpassword1" /><br />
		<li><span>Confirm new password:</span><input type="password" name="newpassword2" /><br />
	</ul>
	<input type="hidden" value="changePassword" name="action" />
	<input type='submit' class='primary button' value='Change password' />
</form>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post">
	<ul class='textInputList'>
		<li><span>Site URL:</span><input type="text" name="siteUrl" value="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
" /><br />
	</ul>
	<input type="hidden" value="changeSiteUrl" name="action" />
	<input type='submit' class='primary button' value='Change site URL' />
</form>