<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function statistic_type()
    {
        return $this->belongsTo('App\StatisticType');
    }

    public function statistic_details()
    {
        return $this->hasMany('App\StatisticDetail');
    }
}
