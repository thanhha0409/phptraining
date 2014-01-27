<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$projectRoot = __DIR__ . '/..';
chdir($projectRoot . '/doctrine'); // config/lake.php読み込みの際に要る模様

// For composer
require_once $projectRoot . "/vendor/autoload.php";

// Require all Entities.
foreach (glob($projectRoot . '/doctrine/model/*.php') as $file) {
	require_once $file;
}

/**
 * @param String $nodename e.g. 'default', 'db2201', etc.
 */
$entityManagerBuilder = function($nodename) use($projectRoot) {
	// require Config to read config/db_*.cnf.php.
	require_once $projectRoot . "/config/base.cnf.php";
	$dbConfig = Config::$mysqlMasterCnf;

	$isDevMode = ! (bool)IN_PRODUCTION;

	// For php format.
	//$config = Setup::createAnnotationMetadataConfiguration(
	//	array($projectRoot . "/doctrine/schema"),
	//	$isDevMode
	//);

	// For YAML format.
	$config = Setup::createYAMLMetadataConfiguration(
		array($projectRoot . "/doctrine/schema"),
		$isDevMode
	);

	// database configuration parameters
	$dbParams = array(
		'driver'   => 'pdo_mysql',
		'host'     => $dbConfig[$nodename]['host'],
		'user'     => $dbConfig[$nodename]['user'],
		'password' => $dbConfig[$nodename]['pass'],
		'dbname'   => $dbConfig[$nodename]['db'],
	);

	// obtaining the entity manager
	return EntityManager::create($dbParams, $config);
};

return $entityManagerBuilder('default');
