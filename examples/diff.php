<?php
declare(strict_types=1);

use Tob\DataTransfer\Entity\VeranstaltungReferent;
use Tob\DataTransfer\Resource\CsvResource;
use Tob\DataTransfer\Resource\DoctrineResource;
use Tob\DataTransfer\Service\DataSynchronizeService;

include_once __DIR__ . '/../vendor/autoload.php';


$identifier = 'Kennummer';

$csvResource = new CsvResource(__DIR__ . '/../data/OS_Referent.csv', $identifier);

$entityManager = include __DIR__ . '/../config/em.php';
$doctrineResource = new DoctrineResource($entityManager, VeranstaltungReferent::class);

$dataSynchronizeService = new DataSynchronizeService($csvResource, $doctrineResource, $identifier);
$dataSynchronizeService->synchronize();