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

        if ($('#div2 .filter__items--wrapper')[0]!== undefined) {
            $('.compare .filter__items')[0].append($('#div2 .filter__items--wrapper')[0]);
        }

        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));

    }

</script>


@section('content')

    <div class="compare">
        <div class="compare__header">
            Compare header
        </div>

        @include('layouts.filter')

        <div class="compare__detail">
            <div class="compare__detail__select comparison">
                <div id="div1" class="compare__detail__select--item" >
                    <div class="div1__wrapper">
                        <a href="/country/{{$country->id}}" target="_self">{{$country->name}}</a>
                    </div>
                </div>

                <div id="div2" class="compare__detail__select--item" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <span class="glyphicon glyphicon glyphicon-remove"></span>
                </div>
            </div>

            <div class="compare__detail__data" id="data-div1">
                <div class="compare__detail__data--item">

                    @include('layouts.statistic_menu')

                </div>

                <div class="compare__detail__data--item" id="data-div2">

                    @include('layouts.statistic_menu')

                </div>
            </div>
        </div>

    </div>
@endsection