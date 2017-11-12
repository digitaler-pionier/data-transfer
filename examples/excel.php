<?php
declare(strict_types=1);

include_once __DIR__ . '/../vendor/autoload.php';

$excel = new PHPExcel();
$excel->setActiveSheetIndex()->setCellValue('A1', 'Hello');

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$writer->save(__DIR__ . '/../data');