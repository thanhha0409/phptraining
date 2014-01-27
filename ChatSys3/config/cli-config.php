<?php
/**
 * This file name(cli-config.php) and placed directory($PROJECT_ROOT/config)
 * should not be changed.
 * vendor/bin/doctrine use this file.
 */
$entityManager = require __DIR__ . '/../doctrine/bootstrap.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
