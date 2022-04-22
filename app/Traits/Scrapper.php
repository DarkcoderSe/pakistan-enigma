<?php

namespace App\Traits;

use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

trait Scrapper
{
    public function scrap($request)
    {
        $number = $request->get('number');

        $client = new Client();
        // Go to the symfony.com website
        $crawler = $client->request('GET', 'https://simdatabaseonline.com/tele/search.php');
        dd($crawler);

        // return collect($result);
    }
}
