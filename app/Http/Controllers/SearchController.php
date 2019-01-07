<?
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Report;

use Illuminate\Database\Eloquent\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search_str = $request->search;
        $reports = Report::where('name', 'like', "%$search_str%")
            ->get();
        $reports = $this->getAsSearchResults($reports);


        return new Response($reports);
    }

    private function getAsSearchResults(Collection $reports)
    {
        return array_map(function($r) {
            return (object)[
                'id' => $r->id,
                'name' => $r->name,
                'authors' => $r->employees,
                'short_report_text' => $r->short_report_text
            ];
        } ,$reports->all());
    }
}