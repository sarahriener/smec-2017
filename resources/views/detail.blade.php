@extends('layouts.app')

@section('title', 'Detail')

@include('layouts.header')


@section('content')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div class="detail">


        <div class="nav__top">
            <!--a href="/overview" class="nav__top__back"><span class="glyphicon glyphicon-menu-left"></span>Back to overview</a-->
            <div class="nav__top__breadcrumbs">
                <!-- TODO breadcrumb Klasse bennenen auch in CSS -->
                <ol class="nav__top__breadcrumb">
                    <li><a href="/">Google Shopping Compendium</a></li> /
                    <li><a href="/overview">Overview</a></li> /
                    <li class="active">{{ $country->name }}</li>
                </ol>
            </div>
        </div>

        @include('layouts.filter')

        <div class="menu__left">
            @include('layouts.statistic_menu')
        </div>

        <div class="country">

            <h1>{{ $country->name }}
                <a class="compareBtn" href="/compare/{{ $country->id }}" target="_self" class="btn btn-default subs-btn">Compare</a>
            </h1>

            <div class="detail-content">
                <p class="intro-text">
                    {{$country->description}}
                    {{$country->name}} is also one of the 26 Google Shopping-Countries. Facts and Figures about E-commerce in {{$country->name}} are presented below.
                    <br><br>
                </p>
                <div class="statistic-data detail-data" data-country="{{ $country->id }}">
                    <p>Select a statistic type.</p>
                </div>
            </div>
        </div>
    </div>

@endsection