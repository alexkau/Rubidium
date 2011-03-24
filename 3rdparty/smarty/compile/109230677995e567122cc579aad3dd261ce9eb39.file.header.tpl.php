<?php /* Smarty version Smarty-3.0.6, created on 2011-03-22 13:31:46
         compiled from "/htdocs/rubidium/templates/modules/admin/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14086580194d890732045d56-02534627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '109230677995e567122cc579aad3dd261ce9eb39' => 
    array (
      0 => '/htdocs/rubidium/templates/modules/admin/header.tpl',
      1 => 1300825905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14086580194d890732045d56-02534627',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
		<div id='header'>
			<h1>Rubidium Admin CP</h1>
			<div id='topright'>
				<span id='index'>
					<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php">Site Index</a>
				</span>
				<?php if ($_smarty_tpl->getVariable('loadInfo')->value['authorized']&&$_smarty_tpl->getVariable('loadInfo')->value['templateToLoad']!='logout'){?>
					<span id='logout'>
						|&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('config')->value['base_url'];?>
/index.php?mode=admin&module=admin&section=logout">Log out</a>
					</span>
				<?php }?>
			</div>
		</div>
