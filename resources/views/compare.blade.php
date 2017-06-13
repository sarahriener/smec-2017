@extends('layouts.app')

@section('title', 'Compare')

<script>

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();

        if ($('#div2 .filter__items__wrapper')[0]!== undefined) {
            $('.compare .filter__items')[0].append($('#div2 .filter__items__wrapper')[0]);
        }

        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));

    }

</script>


@section('content')

        @include('layouts.header')

        <a href="/country/{{ $country->id }}" class="button__back"><span class="glyphicon glyphicon-menu-left"></span>Back to countries</a>

        @include('layouts.filter')

        <div class="compare__detail">
            <div class="compare__detail__select comparison">
                <div id="div1" class="compare__detail__select__item" >
                    <div class="div1__wrapper">
                        <a href="/country/{{$country->id}}" target="_self">{{$country->name}}</a>
                    </div>
                </div>

                <div id="div2" class="compare__detail__select__item" ondrop="drop(event)" ondragover="allowDrop(event)">
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
