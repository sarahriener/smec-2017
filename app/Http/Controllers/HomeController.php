<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

// MODELS
use App\Continent;
use App\Country;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $continents = $this->getAllContinents();
        $countries = $this->getAllCountries();

         return view('overview', ['continents' => $continents, 'countries' => $countries]);
    }

    public function detail()
    {
        $continents = $this->getAllContinents();
        $countries = $this->getAllCountries();

        return view('detail', ['continents' => $continents, 'countries' => $countries]);
    }

    public function compare()
    {
        $continents = $this->getAllContinents();
        $countries = $this->getAllCountries();

        return view('compare', ['continents' => $continents, 'countries' => $countries]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c = Country::find(1);
        $c->getCountriesByContinent(1);
        $countriesByContinent = $this->getCountriesPerContinent($id);
        Log::info('Countries per continent '.$countriesByContinent->get());

        return view('overview', ['countryTest' => $countriesByContinent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCountriesPerContinent($id) {
        return Country::where('continent_id', $id);
    }

    public function getCountryByName($name) {
        return Country::where('name', $name)->first();
    }

    public function getAllContinents() {
        return Continent::all();
    }

    public function getAllCountries() {
        return Country::all();
    }
}
