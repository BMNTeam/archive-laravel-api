<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    public function articles()
    {
        return $this->belongsToMany('App\Article', 'employee_article_ref', 'employee_id', 'article_id');
    }

    public function reports()
    {
        return $this->belongsToMany('App\Report', 'report_employee_ref', 'employee_id', 'report_id');
    }
}