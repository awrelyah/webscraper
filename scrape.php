<?php

require __DIR__.'/vendor/autoload.php';

if(!is_dir('./cache')){
    mkdir('./cache');
}

$client = new GuzzleHttp\CLient(['verify' => false]);
$url = 'https://abstrusegoose.com/';
for($i = 0 ; $i < 10 ; $i++){
    if(file_exists('./cache/'. $i . 'html')){
        $html = file_get_contents('./cache/'. $i . 'html');
    } else {
        $response = $client->get($url);
        $html = $response->getBody()->getContents();
        file_put_contents('./cache/'. $i . 'html', $html);
    }
    $crawler = new \Symfony\Component\DomCrawler\Crawler($html);
    $imgEl = $crawler->filter('section>img');
    var_dump($imgEl->attr('src'));
    var_dump($imgEl->attr('title'));
    var_dump($imgEl->attr('alt'));
    $link = $crawler->filter('body>section>p:nth-child(1)>a:nth-child(2)');
    $url = $link->attr('href');
}