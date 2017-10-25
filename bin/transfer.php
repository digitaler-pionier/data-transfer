<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Tob\DataTransfer\Entity\VeranstaltungReferent;
use Tob\DataTransfer\Reader\CsvReader;
use Tob\DataTransfer\Service\DataTransferService;
use Tob\DataTransfer\Writer\DoctrineWriter;

include_once __DIR__ . '/../vendor/autoload.php';

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

$csvReader = new CsvReader();
$consoleWriter = new DoctrineWriter($entityManager);

$dataTransferService = new DataTransferService($csvReader, $consoleWriter);
$dataTransferService->transfer(__DIR__ . '/../data/OS_Referent.csv', VeranstaltungReferent::class);