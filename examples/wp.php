<?php

include_once __DIR__ . '/../vendor/autoload.php';


$client = new \GuzzleHttp\Client(['base_uri' => 'http://www.tobiasoberrauch.de/wp-json/']);
$wordPressPageResource = new Tob\DataTransfer\Resource\WordPress\PostResource($client);
$posts = $wordPressPageResource->findAll();
$post = $wordPressPageResource->find(43);


