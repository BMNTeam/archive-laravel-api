<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table = 'reports';

    public function manager()
    {
        return $this->hasOne('App\Manager', 'id');
    }

    public function articles()
    {
        return $this->belongsToMany('App\Article', 'report_article_ref', 'report_id', 'article_id');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Employee', 'report_employee_ref', 'report_id', 'employee_id');
    }

}
