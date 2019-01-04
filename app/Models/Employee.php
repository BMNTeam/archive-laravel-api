<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    public function articles()
    {
        $this->belongsToMany('App\Article', 'employee_article_ref', 'employee_id', 'article_id');
    }
}