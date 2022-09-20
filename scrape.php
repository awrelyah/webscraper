<?php

require __DIR__.'/vendor/autoload.php';

if(!is_dir('./cache')){
    mkdir('./cache');
}

$client = new GuzzleHttp\CLient(['verify' => false]);
for($i = 610; $i > 600; $i--){
    if(file_exists('./cache/'. $i . 'html')){
        $html = file_get_contents('./cache/'. $i . 'html');
    } else {
        $response = $client->get('https://abstrusegoose.com/'. $i);
        $html = $response->getBody()->getContents();
        file_put_contents('./cache/'. $i . 'html', $html);
    }
    $crawler = new \Symfony\Component\DomCrawler\Crawler($html);
    $imgEl = $crawler->filter('section img');
    var_dump($imgEl->attr('src'));
    var_dump($imgEl->attr('title'));
    var_dump($imgEl->attr('alt'));
}