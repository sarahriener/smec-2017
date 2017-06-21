@extends('layouts.app')

@section('title', 'Compare')

@section('content')
    <div class="compare">
        @include('layouts.header')

        <div class="nav__top">
            <a href="/country/{{ $country->id }}" class="nav__top__back"><span class="glyphicon glyphicon-menu-left"></span>Back to countries</a>

            <div class="nav__top__breadcrumbs">
                <!-- TODO breadcrumb Klasse bennenen auch in CSS -->
                <ol class="nav__top__breadcrumb">
                    <li><a href="/">Google Shopping Compendium</a></li> /
                    <li><a href="/overview">Overview</a></li> /
                    <li class="active"><a href="/country/{{ $country->id }}">{{ $country->name }}</a></li> /
                    <li class="active"><a href="/compare/{{ $country->id }}">Compare with {{ $country->name }}</a></li>
                </ol>
            </div>
        </div>


        @include('layouts.filter')

        <div class="compare__detail">
            <div class="compare__detail__select comparison">
                <div id="div1" class="compare__detail__select__item" >
                    <div class="div1__wrapper">
                        <img class="compare__flag" src="/img/flags/{{$country->code}}.svg">
                        <a href="/country/{{$country->id}}" target="_self">{{$country->name}}</a>
                    </div>
                </div>

                <div id="div2" class="compare__detail__select__item">
                </div>
            </div>

            <div class="compare__detail__data" >
                <div class="compare__detail__data__item" id="data-div1">

                    @include('layouts.statistic_menu')

                </div>

                <div class="compare__detail__data__item" id="data-div2">

                    @include('layouts.statistic_menu')

                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>


@endsection
