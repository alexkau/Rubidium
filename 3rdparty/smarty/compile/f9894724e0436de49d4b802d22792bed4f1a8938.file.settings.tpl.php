<?php /* Smarty version Smarty-3.0.6, created on 2011-03-13 13:25:21
         compiled from "/var/www/rubidium/templates/modules/admin/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16228856704d7d2831162422-12639171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9894724e0436de49d4b802d22792bed4f1a8938' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/settings.tpl',
      1 => 1300047920,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16228856704d7d2831162422-12639171',
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
<span class='indent'>Old password:</span><input type="password" name="oldpassword" /><br />
<span class='indent'>New password:</span><input type="password" name="newpassword1" /><br />
<span class='indent'>Confirm new password:</span><input type="password" name="newpassword2" /><br />
<input type='submit' class='primary button' value='Change password' />
</form>
