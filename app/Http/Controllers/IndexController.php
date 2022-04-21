<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte;
use Symfony\Component\DomCrawler\Crawler;

class IndexController extends Controller
{
	public function index()
	{
        return view('welcome');
	}

    public function submit(Request $request)
    {
        $result = collect([]);
        $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:html'
        ]);

        // dd($req->all());
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                // $file->store('files');
                $content = file_get_contents($file->getRealPath());
                $data = $this->scrap($content);
                // dd($data);
                $result = $result->merge($data);
                $result->all();
                // $result[] = $data;
            }
        }


        return $result;

    }

    public function scrap($path)
    {
		$names = [];
		$phone = [];
		$email = [];

        // $crawler = Goutte::request('GET', $path);
        $crawler = new Crawler($path);


		$nodeCount = 0;
        $crawler->filter('.cvsrcbox_body')->each(function ($node) use (&$names, &$nodeCount, &$phone, &$email) {

			$node->filter('.cvappname')->each(function ($childNode) use (&$names, &$nodeCount) {
				$names[$nodeCount] = $childNode->text();
			});

			$dump = $node->filter('.lpstf')->eq(0)->text('-1');

			if (strpos($dump, '+92') !== false) {
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
