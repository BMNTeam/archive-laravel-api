<?
namespace App\Http\Controllers;

use App\Article;
use App\Journal;
use App\Reports\ArticleFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::all();
        foreach ($articles as $article)
        {
            $this->getJournal($article);
        }
        return new Response($articles);
    }

    private function getJournal(Article $article)
    {
        $article["journal"] = Journal::where('id', $article->journal_id)->first();
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
        $article = new Article();
        $article_file = new ArticleFile($request->fullText);
        $authors_ids = array_map(
            function($a) {return $a->value;},
            json_decode($request->authors)
        );


        $article->name = $request->name;
        $article->journal_id = json_decode($request->journal)->value;
        $article->full_text = $article_file->getFileContent();
        $article->link = $article_file->getFullPath();
        $article->save();

        $article->authors()->attach($authors_ids);
        $this->getJournal($article);

        return new Response($article);

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}