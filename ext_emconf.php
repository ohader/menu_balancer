<?php

########################################################################
# Extension Manager/Repository config file for ext "menu_balancer".
#
# Auto generated 30-09-2011 19:01
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
	'dependencies' => '',
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
	'version' => '0.9.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:13:{s:10:"README.txt";s:4:"e3c4";s:16:"ext_autoload.php";s:4:"214d";s:12:"ext_icon.gif";s:4:"1bdc";s:14:"ext_tables.php";s:4:"367d";s:20:"Classes/Renderer.php";s:4:"05a9";s:36:"Classes/Model/AbstractCollection.php";s:4:"e5ac";s:40:"Classes/Model/BalancedPartCollection.php";s:4:"74dc";s:31:"Classes/Model/Configuration.php";s:4:"5999";s:22:"Classes/Model/Part.php";s:4:"deea";s:32:"Classes/Model/PartCollection.php";s:4:"9f6c";s:28:"Classes/Service/Balancer.php";s:4:"7843";s:28:"Classes/Service/Splitter.php";s:4:"9e36";s:34:"Configuration/TypoScript/setup.txt";s:4:"3e29";}',
	'suggests' => array(
	),
);

?>