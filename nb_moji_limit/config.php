<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['name'] = 'NB Moji Limit';
$config['version'] = '2.1';
$config['nsm_addon_updater']['versions_xml'] = 'http://nicolasbottari.com/expressionengine_cms/version_check/nb_moji_limit';
if( ! defined('NB_MOJI_LIMIT_VER') )
{
	define('NB_MOJI_LIMIT_VER', $config['version']);
	define('NB_MOJI_LIMIT_NAME', $config['name']);
}