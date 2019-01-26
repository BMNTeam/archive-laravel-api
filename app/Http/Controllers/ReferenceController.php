<?
namespace App\Http\Controllers;

use App\Reference;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReferenceController extends Controller
{
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
        $journal = new Reference();

        $journal->name = $request->name;
        $journal->url = $request->url;

        $journal->save();

        new Response($journal, 200);
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