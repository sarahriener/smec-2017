<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;

// MODELS
use App\StatisticType;
use App\Statistic;
use App\StatisticDetail;
use App\Country;

class HomeController extends Controller
{
    private $TYPE = 'Sales';
    private $sTypeId;

    public function __construct() {
        $this->sTypeId = StatisticType::where('name', $this->TYPE)->first()->id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aggregatedSales = $this->getAggregatedSales();
        $aggregatedFutureSales = $this->getAggregatedFutureSales();
        $salesOfCountry = $this->getSalesOfCountry();

        return view('welcome', ['aggregatedSales' => $aggregatedSales, 'aggregatedFutureSales' => $aggregatedFutureSales,
            'salesOfCountry' => $salesOfCountry]);
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
        $aCountry = array();

        // Get random one random country
        $oCountries = Country::all();
        $min = 0;
        $max = sizeof($oCountries) - 1;

        $random = rand($min, $max);
        $oCountry = $oCountries[$random];

        $aCountry['name'] = $oCountry->name;

        // Get current sales of this country
        $oCountryStatistic = Statistic::where('statistic_type_id', $this->sTypeId)
            ->where('country_id', $oCountry->id)
            ->first();

        Log::info("Statistic: " . $oCountryStatistic);

        if($oCountryStatistic) {
            $oStatisticDetails = StatisticDetail::where('statistic_id', $oCountryStatistic->id)->first();

            $oStatisticDetails ? $aCountry['sales'] = $oStatisticDetails->value : $aCountry['sales'] = "No current sales available!";
        } else {
            $aCountry['sales'] = "No current sales available!";
        }

        return (object) $aCountry;
    }

}
