<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;

// MODELS
use App\StatisticType;
use App\Statistic;
use App\StatisticDetail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('In HomeController');

        $aggregatedSales = $this->getAggregatedSales();
        $aggregatedFutureSales = $this->getAggregatedFutureSales();
        $salesOfCountry = $this->getSalesOfCountry();

        return view('welcome', ['aggregatedSales' => $aggregatedSales, 'aggregatedFutureSales' => $aggregatedFutureSales,
            'salesOfCountry' => $salesOfCountry]);
        //return view('welcome',  ['aggregatedSales' => [1,2]]);

    }

    private function getAggregatedSales() {
        $type = 'Sales';

        /* SELECT one
            FROM table
            WHERE datetimefield <= now.year
            ORDER BY datetimefield DESC
            LIMIT 1; */

        // get type sales
        // get all details of type with year

        $statistic_type_id = StatisticType::where('name', $type)->first()->id;
        // array with all statistic entries
        $statistic_ids = Statistic::where('statistic_type_id', $statistic_type_id);
        //StatisticDetail::

        return 0;
    }

    private function getAggregatedFutureSales() {
        /*
         * SELECT MAX(year)
FROM table;
         * */

        return 0;
    }

    /**
     * Get current sales of a random country
     */
    private function getSalesOfCountry() {
        /*get all ids, store in array, get random number between 0 and length-1*/
        return array();
    }

}
