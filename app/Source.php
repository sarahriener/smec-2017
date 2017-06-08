<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function statistic_detail()
    {
        return $this->belongsTo('App\StatisticDetail');
    }
}
