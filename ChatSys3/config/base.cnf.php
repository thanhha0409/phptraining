<?php
$projectRoot = '..';

require_once($projectRoot . '/config/lake.php');

define('HASUNOHA_DIR', $projectRoot . '/../hasunoha3');
define('BASE_DIR', '/');
define('VIEW_EXT', '.html');
define('LIB_VER', '2010021000/');
define('CONFIG_DIR', $projectRoot . '/config/' . Lake::lakeId());

if (! defined('IN_PRODUCTION')) {
    define('IN_PRODUCTION', 0);
}

if (IN_PRODUCTION) {
    require(CONFIG_DIR.'/env_product.cnf.php');
    require(CONFIG_DIR.'/db_product.cnf.php');
} else {
    require(CONFIG_DIR.'/env_dev.cnf.php');
    require(CONFIG_DIR.'/db_dev.cnf.php');
}

// composer読み込み
if (is_file($projectRoot . '/vendor/autoload.php')) {
	require_once($projectRoot . '/vendor/autoload.php');
}
