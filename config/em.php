<?php
declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

$connection = [
    'driver'   => 'sqlsrv',
    'host'     => 'mssql',
    'port'     => '1433',
    'user'     => 'sa',
    'password' => 'P@55w0rd',
];
$paths = [
    __DIR__ . '/../src/Entity',
];
$reader = new AnnotationReader();
$driver = new AnnotationDriver($reader, $paths);

$config = Setup::createAnnotationMetadataConfiguration($paths, true);
$config->setMetadataDriverImpl($driver);

return EntityManager::create($connection, $config);
