<?php /* Smarty version Smarty-3.0.6, created on 2011-03-10 18:01:43
         compiled from "/var/www/rubidium/templates/modules/admin/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20754706364d7982874908c7-41123017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '479a6a88c8ba0d2bfd0175ff278fad8d63ca1947' => 
    array (
      0 => '/var/www/rubidium/templates/modules/admin/header.tpl',
      1 => 1299808900,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20754706364d7982874908c7-41123017',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
		<div id='header'>
			<h1 style='float: left'>Rubidium Admin CP</h1>
			<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?>
				<span class='right'>
					<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=admin&module=admin&section=logout">Log out</a>
				</span><br />
			<?php }?>
			<ul style='display: block; clear:both'><li>Placeholder for header links</li></ul>
		</div>
