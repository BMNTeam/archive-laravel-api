<?
namespace App\Http\Controllers;

use App\Reference;
use App\Reports\ReferenceFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\GetIdsList;


class ReferenceController extends Controller
{
    use GetIdsList;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        // TODO refactor as a normal functions
        $short_report_file = new ReferenceFile($request->text, $request->name);

        $report = new Reference();
        $report->name = $request->name;
        $report->theme_number = $request->theme_number;
        $report->date = strtotime($request->date);

        $report->text = $short_report_file->getFileContent();
        $report->url = $short_report_file->getFullPath();


        $report->save();

        $report->employees()->attach($this->getIdsList($request->employees));

        return new Response($report, 200);
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Reference $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Reference $journal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reference $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Reference $journal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Reference  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reference $journal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reference  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reference $journal)
    {
        //
    }
}