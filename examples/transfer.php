<?php
declare(strict_types=1);

use Tob\DataTransfer\Entity\VeranstaltungReferent;
use Tob\DataTransfer\Resource\CsvResource;
use Tob\DataTransfer\Resource\DoctrineResource;
use Tob\DataTransfer\Service\DataTransferService;

include_once __DIR__ . '/../vendor/autoload.php';

$csvResource = new CsvResource(__DIR__ . '/../data/OS_Referent.csv', 'Kennummer');

$entityManager = include __DIR__ . '/../config/em.php';
$doctrineResource = new DoctrineResource($entityManager, VeranstaltungReferent::class);

$dataTransferService = new DataTransferService($csvResource, $doctrineResource);
$dataTransferService->transfer();