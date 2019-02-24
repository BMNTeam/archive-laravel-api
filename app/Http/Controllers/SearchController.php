<?
namespace App\Http\Controllers;

use App\Journal;
use App\Reference;
use App\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Report;

use Illuminate\Database\Eloquent\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search_str = $request->search;


        if($request->type === 'report') return new Response($this->getReports($search_str));

        if($request->type === 'reference')return new Response($this->getReferences($search_str));

        // #region implement ranking
        // $items = $reports->all();
        // TODO: reorder items by rank
//        $results = array_map(
//            function($i, $search_str){ return new Search($i, $search_str);},
//            $items,
//            array_fill(0, count($items), $search_str)
//        );
        // $name =
        // #endregion

        $reports = $this->getReports($search_str);
        $references = $this->getReferences($search_str);

        $results = array_merge($references, $reports);
        return new Response($results);
    }

    public function download(Request $request)
    {
        $file = $request->query('file');
        return response()->download(storage_path('app/'.$file));
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

    private function getReports(string $search_str)
    {
        $reports = $this->getReportsCollection($search_str);
        return $this->getAsSearchResults($reports);
    }

    private function getReferences(string $search_str)
    {
        $references = $this->getReferencesCollection($search_str);
        return $this->getAsSearchResults($references, false);
    }

    public function getSingle(Request $request)
    {
        $res = null;
        if($request->type === "report")
        {
            $res = Report::where('id', $request->id)->first();
            $articles = $res->articles()->get();

            foreach ($articles as $article)
            {
                $article['journal']= Journal::where('id', $article->journal_id)->first();
            }
            $res["articles"] = $articles;
            $res = $this->getLinkedData($res, true);
            return new Response($res);
        }

        if($request->type === "reference")
        {
            $res = Reference::where('id', $request->id)->first();
            $res = $this->getLinkedData($res);
            return new Response($res);
        }
    }

    private function getLinkedData(Model $res, $with_manager = false)
    {
        if($with_manager) {
            $res["manager"] = Manager::where("id", $res->manager_id)->first();
        };
        $res["employees"] = $res->employees()->get();
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
                'text' => mb_substr($type_report ? $r->short_report_text : $r->text, 0, 400)."..."
            ];
        } ,$reports->all(), array_fill(0, count($reports->all()), $type_report));
    }
}
