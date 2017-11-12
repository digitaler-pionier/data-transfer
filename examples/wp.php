<?php
declare(strict_types=1);

include_once __DIR__ . '/../vendor/autoload.php';


$client = new \GuzzleHttp\Client(['base_uri' => 'http://www.tobiasoberrauch.de/wp-json/']);
$wordPressPageResource = new \Tob\DataTransfer\Resource\WordPress\PageResource($client);
$posts = $wordPressPageResource->findAll();

foreach ($posts as $post) {

    $html = $post['content']['rendered'];

    $doc = new VsWord();
    $parser = new HtmlParser($doc);
    $parser->parse($html);
    $doc->saveAs('examples/wp/' . $post['id'] . '.docx');

}
