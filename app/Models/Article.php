<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public function journal_id ()
    {
        return $this->belongsTo('App\Journal');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Employee', 'employee_article_ref', 'article_id', 'employee_id');
    }
}