<?
namespace App\Http\Controllers;

use App\Reference;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Search;
use App\Report;

use Illuminate\Database\Eloquent\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search_str = $request->search;

        $reports = $this->getReportsCollection($search_str);
        $references = $this->getReferencesCollection($search_str);

        // TODO: finish with response depending on search type option

        if($request->type === 'report')
        {
        }

        if($request->type === 'reference')
        {
        }



        // $items = $reports->all();
        // TODO: reorder items by rank
//        $results = array_map(
//            function($i, $search_str){ return new Search($i, $search_str);},
//            $items,
//            array_fill(0, count($items), $search_str)
//        );
        // $name =
        $reports =$this->getAsSearchResults($reports);
        $references = $this->getAsSearchResults($references, false);
        $results = array_merge($references, $reports);


        return new Response($results);
    }

    private function getReferencesCollection(string $search_str)
    {
        return Reference::where('name', 'like', "%$search_str%")
            ->orWhere('text', 'like', "%$search_str%")
            ->get();
    }

    private function getReportsCollection(string $search_str)
    {
        return Report::where('name', 'like', "%$search_str%")
            ->orWhere('short_report_text', 'like', "%$search_str%")
            ->orWhere('full_report_text', 'like', "%$search_str%")
            ->get();
    }

    public function getSingle(Request $request)
    {
        $res = null;
        if($request->type === "report")
        {
            $res = Report::where('id', $request->id)->first();
            $res["articles"] = $res->articles()->get();
            $res["manager"] = $res->manager()->first();
            $res["employees"] = $res->employees()->get();
        }

        return $res;


    }

    private function getAsSearchResults(Collection $reports, $type_report = true)
    {
        return array_map(function($r, $type_report) {
            return (object)[
                'id' => $r->id,
                'name' => $r->name,
                'authors' => $r->employees,
                'type' => $type_report ? "report" : "reference",
                'text' => substr($type_report ? $r->short_report_text : $r->text, 0, 400)."..."
            ];
        } ,$reports->all(), array_fill(0, count($reports->all()), $type_report));
    }
}