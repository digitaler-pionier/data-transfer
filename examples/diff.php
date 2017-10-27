<?php

use Tob\DataTransfer\Resource\ArrayResource;
use Tob\DataTransfer\Service\DataSynchronizeService;

include_once __DIR__ . '/../vendor/autoload.php';



$identifier = 'id';

$items = [
    [
        $identifier => 2,
        'name'      => 'Zwei',
    ],
    [
        $identifier => 3,
        'name'      => 'Drei',
    ],
];
$csvResource = new ArrayResource($items, $identifier);

$items = [
    [
        $identifier => 1,
        'name'      => 'Eins',
    ],
    [
        $identifier => 2,
        'name'      => 'Two',
    ],
];
$doctrineResource = new ArrayResource($items, $identifier);


$dataSynchronizeService = new DataSynchronizeService($csvResource, $doctrineResource, $identifier);
$dataSynchronizeService->synchronize();








#$csvResource = new CsvResource(__DIR__ . '/../data/OS_Referent.csv', 'Kennummer');
#$doctrineResource = new DoctrineResource($entityManager, VeranstaltungReferent::class);

