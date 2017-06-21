@extends('layouts.app')

@section('title', 'Detail')


@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <div class="detail">
        @include('layouts.header')

        <div class="nav__top">
            <a href="/overview" class="nav__top__back"><span class="glyphicon glyphicon-menu-left"></span>Back to overview</a>

            <div class="nav__top__breadcrumbs">
                <!-- TODO breadcrumb Klasse bennenen auch in CSS -->
                <ol class="nav__top__breadcrumb">
                    <!--!!update!! href link (startpage)-->
                    <li><a href="/">Google Shopping Compendium</a></li> /
                    <li><a href="/overview">Overview</a></li> /
                    <!--!!update!! href link (startpage) section attributes-->
                    <li class="active"><a href="/country/{{ $country->id }}">{{ $country->name }}</a></li>
                </ol>
            </div>
        </div>


        @include('layouts.filter')

        <div class="menu__left">
            @include('layouts.statistic_menu')
        </div>

        <div class="country">

            <h1>{{ $country->name }}
            <!-- TODO wenn Country Img drinnen darauf zugreifen-->
               <!-- <img src="../assets/img/flags" alt="{{ $country->code }}" height="20"> -->
                <a class="compareBtn" href="/compare/{{ $country->id }}" target="_self" class="btn btn-default subs-btn">Compare</a>
            </h1>

            <div class="detail-content">
                <p class="intro-text"> {{$country->name}} is one of the 26 Google Shopping-Countries. Facts and Figures about E-Commerce in {{$country->name}} in are presented bellow.  </p>

                <div class="statistic-data detail-data" data-country="{{ $country->id }}">
                    <p>Select a statistic type.</p>
                </div>
            </div>
        </div>
    </div>


        <script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>



        <!-- <div id="chartContainer1" class="chart" ></div>
        <div id="chartContainer2" class="chart" ></div><br/>
        <div id="chartContainer3" class="chart" ></div>
        <div id="chartContainer4" class="chart" ></div> -->
        <!-- <img src="../../public/img/cart_icon.png"> -->

        <script type="text/javascript">
            /*var chart = new CanvasJS.Chart("chartContainer1",
                {
                    title:{
                        text: "bla",
                        verticalAlign: 'top',
                        horizontalAlign: 'left'
                    },
                    animationEnabled: true,
                    data: [
                        {
                            type: "doughnut",
                            startAngle:20,
                            toolTipContent: "{label}: {y} - <strong>#percent%</strong>",
                            indexLabel: "{label} #percent%",
                            dataPoints: [
                                {  y: 67, label: "Inbox" },
                                {  y: 28, label: "Archives" },
                                {  y: 10, label: "Labels" },
                                {  y: 7,  label: "Drafts"},
                                {  y: 4,  label: "Trash"}
                            ]
                        }
                    ]
                });
            chart.render();

            var chart = new CanvasJS.Chart("chartContainer2",
                {
                    animationEnabled: true,
                    title: {
                        text: "Pie Chart",
                    },
                    legend: {
                        fontFamily: "arial",

                    },
                    data: [
                        {
                            type: "pie",
                            showInLegend: true,
                            dataPoints: [
                                { y: 4181563, legendText: "PS 3", indexLabel: "PlayStation 3" },
                                { y: 2175498, legendText: "Wii", indexLabel: "Wii" },
                                { y: 3125844, legendText: "360", indexLabel: "Xbox 360" },
                                { y: 1176121, legendText: "DS", indexLabel: "Nintendo DS" },
                                { y: 1727161, legendText: "PSP", indexLabel: "PSP" },
                                { y: 4303364, legendText: "3DS", indexLabel: "Nintendo 3DS" },
                                { y: 1717786, legendText: "Vita", indexLabel: "PS Vita" }
                            ]
                        },
                    ]
                });
            chart.render();

            var chart = new CanvasJS.Chart("chartContainer3",
                {
                    animationEnabled: true,
                    title: {
                        text: "Line Chart"
                    },
                    legend: {
                        fontFamily: "arial",

                    },
                    axisX: {
                        valueFormatString: "MMM",
                        interval: 1,
                        intervalType: "month"
                    },
                    axisY: {
                        includeZero: false
                    },
                    data: [
                        {
                            type: "line",
                            dataPoints: [
                                { x: new Date(2012, 00, 1), y: 450 },
                                { x: new Date(2012, 01, 1), y: 414 },
                                { x: new Date(2012, 02, 1), y: 520, indexLabel: "highest", markerColor: "red", markerType: "triangle" },
                                { x: new Date(2012, 03, 1), y: 460 },
                                { x: new Date(2012, 04, 1), y: 450 },
                                { x: new Date(2012, 05, 1), y: 500 },
                                { x: new Date(2012, 06, 1), y: 480 },
                                { x: new Date(2012, 07, 1), y: 480 },
                                { x: new Date(2012, 08, 1), y: 410, indexLabel: "lowest", markerColor: "DarkSlateGrey", markerType: "cross" },
                                { x: new Date(2012, 09, 1), y: 500 },
                                { x: new Date(2012, 10, 1), y: 480 },
                                { x: new Date(2012, 11, 1), y: 510 }
                            ]
                        }
                    ]
                });
            chart.render();

            var chart = new CanvasJS.Chart("chartContainer4",
                {
                    animationEnabled: true,
                    title: {
                        text: "Column Chart",
                        fontFamily: "arial",

                    },
                    legend: {
                        fontFamily: "arial",

                    },
                    axisX: {
                        interval: 10,
                    },
                    data: [
                        {
                            type: "column",
                            legendMarkerType: "triangle",
                            legendMarkerColor: "green",
                            color: "rgba(255,12,32,.3)",
                            showInLegend: true,
                            legendText: "Country wise population",
                            dataPoints: [
                                { x: 10, y: 297571, label: "India" },
                                { x: 20, y: 267017, label: "Saudi" },
                                { x: 30, y: 175200, label: "Canada" },
                                { x: 40, y: 154580, label: "Iran" },
                                { x: 50, y: 116000, label: "Russia" },
                                { x: 60, y: 97800, label: "UAE" },
                                { x: 70, y: 20682, label: "US" },
                                { x: 80, y: 20350, label: "China" }
                            ]
                        },
                    ]
                });
            chart.render();*/


        </script>

@endsection