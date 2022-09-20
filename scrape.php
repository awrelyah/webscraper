<?php

require __DIR__.'/vendor/autoload.php';

$client = new GuzzleHttp\CLient(['verify' => false]);
$response = $client->get('https://abstrusegoose.com');
$html = $response->getBody()->getContents();
$crawler = new \Symfony\Component\DomCrawler\Crawler($html);
$imgEl = $crawler->filter('section img');

var_dump($imgEl->attr('src'));
var_dump($imgEl->attr('title'));
var_dump($imgEl->attr('alt'));