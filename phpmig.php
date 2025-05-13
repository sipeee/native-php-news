<?php

use \Phpmig\Adapter;
use \App\Model\ConnectionProvider;

$container = new ArrayObject();
$connProvider = ConnectionProvider::getInstance();

$container['connection'] = $connProvider->getConnection();

// replace this with a better Phpmig\Adapter\AdapterInterface
$container['phpmig.adapter'] = new Adapter\PDO\Sql($container['connection'], 'migrations');

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

// You can also provide an array of migration files
// $container['phpmig.migrations'] = array_merge(
//     glob('migrations_1/*.php'),
//     glob('migrations_2/*.php')
// );

return $container;