<?php

namespace App\Http\Controllers;

use App\Report;
use App\Manager;
use App\Reports\ReportFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait GetIdsList {

    private function getIdsList(string $json_str)
    {
        return array_map(
            function($d) { return $d->value; },
            json_decode($json_str)
        );
    }
}

class ReportController extends Controller
{
    use getIdsList;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reports = Report::all();
        foreach ($reports as $report)
        {
            $report['manager'] = Manager::where("id", $report->manager_id)->first();
        }
        return new Response($reports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        // TODO refactor as a normal functions
        $short_report_file = new ReportFile($request->short_report, $request->name);
        $full_report_file = new ReportFile($request->full_report, $request->name);
        $presentation_file = new ReportFile($request->presentation, $request->name);

        $report = new Report();
        $report->name = $request->name;
        $report->theme_number = $request->theme_number;
        $report->date = strtotime($request->date);
        $report->manager_id = json_decode($request->manager)->value;

        $report->short_report_text = $short_report_file->getFileContent();
        $report->short_report_url = $short_report_file->getFullPath();
        $report->full_report_text = ""; // TODO: refactor with big data $full_report_file->getFileContent();
        $report->full_report_url = $full_report_file->getFullPath();
        $report->presentation_url = $presentation_file->getFullPath();


        $report->save();

        $report->employees()->attach($this->getIdsList($request->employees));
        $report->articles()->attach($this->getIdsList($request->articles));

        return new Response($report, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
