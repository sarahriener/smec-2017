<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticDetail extends Model
{

    public function statistic()
    {
        return $this->belongsTo('App\Statistic');
    }
}
