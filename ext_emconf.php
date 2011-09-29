<?php

########################################################################
# Extension Manager/Repository config file for ext "menu_balancer".
#
# Auto generated 29-09-2011 21:40
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Menu Balancer',
	'description' => 'Balances a list of menu items into a given number of subsets (e.g. columns)',
	'category' => 'fe',
	'author' => 'Oliver Hader',
	'author_email' => 'oliver.hader@typo3.org',
	'shy' => '',
	'dependencies' => 'cms',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:13:{s:10:"README.txt";s:4:"e3c4";s:16:"ext_autoload.php";s:4:"214d";s:12:"ext_icon.gif";s:4:"1bdc";s:14:"ext_tables.php";s:4:"367d";s:20:"Classes/Renderer.php";s:4:"1bd2";s:36:"Classes/Model/AbstractCollection.php";s:4:"34d1";s:40:"Classes/Model/BalancedPartCollection.php";s:4:"a2bd";s:31:"Classes/Model/Configuration.php";s:4:"9541";s:22:"Classes/Model/Part.php";s:4:"731c";s:32:"Classes/Model/PartCollection.php";s:4:"df0f";s:28:"Classes/Service/Balancer.php";s:4:"1595";s:28:"Classes/Service/Splitter.php";s:4:"3cd8";s:34:"Configuration/TypoScript/setup.txt";s:4:"3e29";}',
	'suggests' => array(
	),
);

?>