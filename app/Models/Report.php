<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table = 'reports';

    public function manager()
    {
        $this->hasOne('App\Manager');
    }

}
