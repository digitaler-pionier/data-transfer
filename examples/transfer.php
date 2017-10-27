<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Tob\DataTransfer\Entity\VeranstaltungReferent;
use Tob\DataTransfer\Resource\CsvResource;
use Tob\DataTransfer\Resource\DoctrineResource;
use Tob\DataTransfer\Service\DataTransferService;

include_once __DIR__ . '/../vendor/autoload.php';

$csvResource = new CsvResource(__DIR__ . '/../data/OS_Referent.csv', 'Kennummer');

$connection = [
    'driver' => 'sqlsrv',
    'host'   => 'localhost',
    'port'   => '1444',
    'user'   => 'sa',
    'pass'   => 'P@55w0rd',
];
$paths = [
    __DIR__ . '/../src/Entity',
];
$config = Setup::createAnnotationMetadataConfiguration($paths, true);
$entityManager = EntityManager::create($connection, $config);

$doctrineResource = new DoctrineResource($entityManager, VeranstaltungReferent::class);

$dataTransferService = new DataTransferService($csvResource, $doctrineResource);
$dataTransferService->transfer();