<?php
declare(strict_types=1);

use SebastianBergmann\CodeCoverage\Report\Text;
use Tob\DataTransfer\Resource\MicrosoftOffice\WordResource;

include_once __DIR__ . '/../vendor/autoload.php';


$wordResource = new WordResource();

$wordDocument = $wordResource->read(__DIR__ . '/../data/hallo.docx');
foreach ($wordDocument->getSections() as $section) {
    /** @var Text[] $elements */
    $elements = $section->getElements();
    foreach ($elements as $element) {
        var_dump($element->getText());
    }
}

