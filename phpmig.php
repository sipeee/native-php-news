<?php

use \Phpmig\Adapter;
use \App\EnvConfig;

$container = new ArrayObject();
$appConfig = EnvConfig::getInstance();

$container['connection'] = $appConfig->createDbConnection();

// replace this with a better Phpmig\Adapter\AdapterInterface
$container['phpmig.adapter'] = new Adapter\PDO\Sql($container['connection'], 'migrations');

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

// You can also provide an array of migration files
// $container['phpmig.migrations'] = array_merge(
//     glob('migrations_1/*.php'),
//     glob('migrations_2/*.php')
// );

return $container;