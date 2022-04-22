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
            'number' => 'required'
        ]);

        $result = $this->scrap($request);

        return view('result')->with([
            'candidates' => $result
        ]);
    }


    public function export(Request $request)
    {
        $export = new CandidateExport($result->toArray());
        return Excel::download($export, 'candidates.xlsx');
    }


}
