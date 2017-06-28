<?php

namespace App\Http\Controllers;
use App\Http\Requests;

// MODELS
use App\Continent;
use App\Country;
use App\StatisticType;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all()->sortBy('name', SORT_ASC);
        $continents = Continent::all()->sortBy('name', SORT_ASC);

        return view('detail', ['continents' => $continents, 'countries' => $countries]);
    }

    /**
     * @param $id
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $countries = Country::all()->sortBy('name', SORT_ASC);
        $continents = Continent::all()->sortBy('name', SORT_ASC);

        $country = Country::find($id);
        $continent = $country->continent();

        $main_statistic_types = StatisticType::all()->where('category_id', null)->sortBy('nav_prio', SORT_ASC);

        $data = ['continents' => $continents, 'countries' => $countries,
            'country'=> $country, 'continent'=> $continent, 'main_statistic_types' => $main_statistic_types];

        return view('detail', $data);
    }

    public function getStatisticDetails(){

        $country_id = $_GET['country_id'];
        $country = Country::find($country_id);

        $type = $_GET['statistic_type'];
        $type= str_replace("_", " ", $type);

        $statistic_type  = StatisticType::all()->where('name', $type)->first();

        $statistic = $country->statistics->where('statistic_type_id', $statistic_type->id)->first();

        $data = array();
        $data['country'] = $country;
        $data['statistic_type'] = $statistic_type; // just one type
        $data['statistic_details'] = null;
        if($statistic){
            $data['statistic_details'] = $statistic->statistic_details; // several details for each type (per year)
        }

        return $data;
    }


    public function getStatisticTypeSubTypes(){
        $statistic_type_id = $_GET['statistic_type_id'];
        $statistic_type = StatisticType::find($statistic_type_id);

        $country_id = $_GET['country_id'];
        $country = Country::find($country_id);

        $subTypes = $statistic_type->subTypes();

        $data = array();
        $no_data_details = true;

        foreach($subTypes as $subType){
            $statistic = $country->statistics->where('statistic_type_id', $subType->id)->first();

            $detail = [];
            $detail['subType'] = $subType;
            $detail['subTypesDetails'] = null;
            if($statistic){
                $detail['subTypesDetails'] = $statistic->statistic_details; // several details for each type (per year)
                $no_data_details = false;
            }

            $data = array_add($data, $subType->name, $detail);
        }

        return $no_data_details ? null : $data;
    }


}