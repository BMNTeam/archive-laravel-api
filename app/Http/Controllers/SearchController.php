<?
namespace App\Http\Controllers;

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
        $reports = Report::where('name', 'like', "%$search_str%")
            ->orWhere('short_report_text', 'like', "%$search_str%")
            ->orWhere('full_report_text', 'like', "%$search_str%")
            ->get();
        // $items = $reports->all();
        // TODO: reorder items by rank
//        $results = array_map(
//            function($i, $search_str){ return new Search($i, $search_str);},
//            $items,
//            array_fill(0, count($items), $search_str)
//        );
        // $name =
        $results = $this->getAsSearchResults($reports);


        return new Response($results);
    }

    public function getSingle(Request $request)
    {
        $res = null;
        if($request->type === "report")
        {
            $res = Report::where('id', $request->id)->first();
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
                'short_report_text' => substr($r->short_report_text, 0, 400)."..."
            ];
        } ,$reports->all(), array_fill(0, count($reports->all()), $type_report));
    }
}