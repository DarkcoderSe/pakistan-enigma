<?php

namespace App\Traits;

use Symfony\Component\DomCrawler\Crawler;
use Goutte;

trait Scrapper
{
    public function scrap($content, $request)
    {
		$names = [];
		$phone = [];
		$email = [];

        $crawler = new Crawler($content);

		$nodeCount = 0;
        $crawler->filter('.cvsrcbox_body')->each(function ($node) use (&$names, &$nodeCount, &$phone, &$email) {

			$node->filter('.cvappname')->each(function ($childNode) use (&$names, &$nodeCount) {
				$names[$nodeCount] = $childNode->text();
			});

			$dump = $node->filter('.lpstf')->eq(0)->text('-1');

			if (strpos($dump, '+92') !== false || strpos($dump, '@') !== false) {
				$dumpCollection = explode(' ', $dump);
				$text = [];
				foreach ($dumpCollection as $dumpText) {
					if (strlen($dumpText) > 11) {
						// $text[] = $dumpText;
						if (strpos($dumpText, '+92') !== false) {
							$phone[$nodeCount] = $dumpText;
						}
						else if (strpos($dumpText, '@') !== false) {
							$email[$nodeCount] = $dumpText;
						}
					}
				}
				// $phone[$nodeCount] = $text;
			}


			$nodeCount++;
        });

		// dd($names, $phone, $email);

		$result = [];
		foreach ($names as $key => $name) {
			$result[] = collect([
				'name' => $name,
				'phone' => $phone[$key] ?? '',
				'email' => $email[$key] ?? ''
			]);
		}

        return collect($result);
    }
}
