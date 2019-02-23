<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    //
    protected $table = 'references';

    public function employees()
    {
        return $this->belongsToMany('App\Employee', 'reference_employee_ref', 'reference_id', 'employee_id');
    }

}
