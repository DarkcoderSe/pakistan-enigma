<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\Scrapper;

use App\Exports\CandidateExport;
use Excel;

class IndexController extends Controller
{
    use Scrapper;

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

        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                $content = file_get_contents($file->getRealPath());
                $data = $this->scrap($content, $request);
                $result = $result->merge($data);
                $result->all();
            }
        }

        $headers = ['name'];
        $request->get('phone') == 'on' ? $headers[] = 'phone' : '';
        $request->get('email') == 'on' ? $headers[] = 'email' : '';
        $request->get('current_salary') == 'on' ? $headers[] = 'current_salary' : '';
        $request->get('expected_salary') == 'on' ? $headers[] = 'expected_salary' : '';
        $request->get('experience') == 'on' ? $headers[] = 'experience' : '';

        return view('result')->with([
            'candidates' => $result,
            'headers' => $headers
        ]);
    }


    public function export(Request $request)
    {
        $export = new CandidateExport($result->toArray());
        return Excel::download($export, 'candidates.xlsx');
    }


}
