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
        // array with all statistic entries of type "Sales"
        $statistic_ids = Statistic::where('statistic_type_id', $this->sTypeId)->lists('id');

        $iCurrentYear = StatisticDetail::whereIn('statistic_id', $statistic_ids)
            ->where('year', '<=', date('Y'))
            ->orderBy('year')
            ->take(1)
            ->lists('year')
            ->first();

        $iAggregatedSales = $this->aggregateSales($statistic_ids, $iCurrentYear);

        return $iAggregatedSales;
    }

    private function getAggregatedFutureSales() {
        $statistic_ids = Statistic::where('statistic_type_id', $this->sTypeId)->lists('id');

        $iFutureYear = StatisticDetail::whereIn('statistic_id', $statistic_ids)
            ->max('year');

        $iAggregatedSales = $this->aggregateSales($statistic_ids, $iFutureYear);

        return $iAggregatedSales;
    }

    private function aggregateSales($statistic_ids, $year) {
        $iAggregatedSales = StatisticDetail::whereIn('statistic_id', $statistic_ids)
            ->where('year', $year)
            ->sum('value');

        return $iAggregatedSales;
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

        if($oCountryStatistic) {
            $oStatisticDetails = StatisticDetail::where('statistic_id', $oCountryStatistic->id)->first();

            $oStatisticDetails ? $aCountry['sales'] = $oStatisticDetails->value : $aCountry['sales'] = "No current sales available!";
        } else {
            $aCountry['sales'] = "No current sales available!";
        }

        return (object) $aCountry;
    }

}
