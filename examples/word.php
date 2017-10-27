<?php
include_once __DIR__ . '/../vendor/autoload.php';


$wordResource = new \Tob\DataTransfer\Resource\MicrosoftOffice\WordResource();

$wordDocument = $wordResource->read(__DIR__ . '/../data/hallo.docx');
foreach ($wordDocument->getSections() as $section) {
    /** @var \PhpOffice\PhpWord\Element\Text[] $elements */
    $elements = $section->getElements();
    foreach ($elements as $element) {
        var_dump($element->getText());
    }
}

