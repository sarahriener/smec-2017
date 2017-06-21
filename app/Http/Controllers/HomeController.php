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
    private $sType;
    private $iTypeId;

    public function __construct() {
        $oStatisticType = StatisticType::where('name', $this->TYPE)->first();

        $this->sType = $oStatisticType->type;
        $this->iTypeId = $oStatisticType->id;
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
            'salesOfCountry' => $salesOfCountry, 'type' => $this->sType]);
    }

    private function getAggregatedSales() {
        // array with all statistic entries of type "Sales"
        $statistic_ids = Statistic::where('statistic_type_id', $this->iTypeId)->lists('id');

        $iCurrentYear = StatisticDetail::whereIn('statistic_id', $statistic_ids)
            ->where('year', '<=', date('Y'))
            ->orderBy('year')
            ->take(1)
            ->lists('year')
            ->first();

        $iAggregatedSales = $this->aggregateSales($statistic_ids, $iCurrentYear);

        if(is_numeric($iAggregatedSales)) $iAggregatedSales = $this->formatNumber($iAggregatedSales);

        return $iAggregatedSales;
    }

    private function getAggregatedFutureSales() {
        $statistic_ids = Statistic::where('statistic_type_id', $this->iTypeId)->lists('id');

        $iFutureYear = StatisticDetail::whereIn('statistic_id', $statistic_ids)
            ->max('year');

        $iAggregatedSales = $this->aggregateSales($statistic_ids, $iFutureYear);

        if(is_numeric($iAggregatedSales)) $iAggregatedSales = $this->formatNumber($iAggregatedSales);

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

        $oCountryStatistic = Statistic::where('statistic_type_id', $this->iTypeId)
            ->where('country_id', $oCountry->id)
            ->first();

        if($oCountryStatistic) {
            $oStatisticDetails = StatisticDetail::where('statistic_id', $oCountryStatistic->id)->first();

            //$oStatisticDetails ? $aCountry['sales'] = $oStatisticDetails->value : $aCountry['sales'] = "No current sales available!";
            $oStatisticDetails ? $aCountry['sales'] = $this->formatNumber($oStatisticDetails->value) : $aCountry['sales'] = "";
        } else {
            $aCountry['sales'] = "";
        }

        return (object) $aCountry;
    }

    private function formatNumber($n) {
        if ($n > 1000000000000) return round(($n/1000000000000), 2).' trillion';
        elseif ($n > 1000000000) return round(($n/1000000000), 2).' billion';
        elseif ($n > 1000000) return round(($n/1000000), 2).' million';
        elseif ($n > 1000) return round(($n/1000), 2).' thousand';
    }

}
