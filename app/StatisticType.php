<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticType extends Model
{
    public function statistics()
    {
        return $this->hasMany('App\Statistic');
    }
}
