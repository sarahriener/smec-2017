/**
* Created by manuela_posch on 01.06.17.
*/


@extends('layouts.app')

@section('title', 'Detail')


@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <div class="detail">
        <div class="detail__header">
            Detail header
        </div>

        @include('layouts.filter')

        <div class="menu__left">
            <div>

                <!-- TODO generate right menu-points and submenu -->
                @foreach(\App\StatisticType::all()->where('category_id', null) as $main_statistic_type)

                    <button class="buttons"><span class="text">{{$main_statistic_type->name}}</span></button>
                    <table class="table">
                    <tbody>

                    @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_type->id) as $sub_statistic_type)
                            <tr>
                               <td><a class="text" href="/country/{{$country->id}}/{{ str_replace(" ", "_", $sub_statistic_type->name)}}">{{$sub_statistic_type->name}}</a></td>
                            </tr>
                    @endforeach
                    </table>
                    </tbody>
                @endforeach
                <script>

                    changeCSS();
                    function changeCSS () {
                        console.log("dd");

                        button = document.getElementsByTagName("button")
                        button[6].style.backgroundColor = "#F6CE41";
                        button[7].style.backgroundColor = "#F5852B";
                        button[8].style.backgroundColor = "#E45D5D";
                        button[9].style.backgroundColor = "#C538F4";
                        button[10].style.backgroundColor = "#45A6FA";
                        button[11].style.backgroundColor = "#1DE3E1";

                    }
                    $('.button').css("background-color", "red");
                </script>
            </div>
        </div>


        <div class="panel-group" id="accordion">
            <div class="panel panel-default">

                <a data-toggle="collapse" class="panelColor on" data-parent="#accordion" href="#collapseOne" aria-expanded="true">

                    <div id="identifierNav" class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-key" aria-hidden="true"></i>Identifier
                        </h4>
                    </div>
                </a>
                <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">


                    <div class="panel-body ">
                        <table class="table">
                            <tbody><tr>
                                <td>
                                    <a href="id" class="selected">ID</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="gtin">GTIN</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="mpn">MPN</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="identifier-exists">Identifier Exists</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="item-group-id">Item Group ID</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">

                <a data-toggle="collapse" class="panelColor collapsed" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">

                    <div id="basicsNav" class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>Basic
                        </h4>
                    </div>
                </a>
                <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">

                    <div class="panel-body ">
                        <table class="table">
                            <tbody><tr>
                                <td>
                                    <a href="title">Title</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="description">Description</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="google-product-category">Google Product Category</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="product-type">Product Type</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="condition">Condition</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="brand">Brand</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="link">Link</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="mobile-link">Mobile Link</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">

                <a data-toggle="collapse" class="panelColor collapsed" data-parent="#accordion" href="#collapseThree" aria-expanded="false">

                    <div id="imageNav" class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>Image
                        </h4>
                    </div>
                </a>
                <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">

                    <div class="panel-body ">
                        <table class="table">
                            <tbody><tr>
                                <td>
                                    <a href="image-link">Image Link</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="additional-image-link">Additional Image Link</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">

                <a data-toggle="collapse" class="panelColor collapsed" data-parent="#accordion" href="#collapseFour" aria-expanded="false">

                    <div id="priceNav" class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-usd" aria-hidden="true"></i>Price
                        </h4>
                    </div>
                </a>
                <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false">

                    <div class="panel-body ">
                        <table class="table">
                            <tbody><tr>
                                <td>
                                    <a href="price">Price</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="sale-price">Sale Price</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="sale-price-effective-date">Sale Price Effective Date</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="unit-pricing-measure">Unit Pricing Measure</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="unit-pricing-base-measure">Unit Pricing Base Measure</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">

                <a data-toggle="collapse" class="panelColor collapsed" data-parent="#accordion" href="#collapseFive" aria-expanded="false">

                    <div id="shippingNav" class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-truck" aria-hidden="true"></i>Shipping
                        </h4>
                    </div>
                </a>
                <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false">

                    <div class="panel-body ">
                        <table class="table">
                            <tbody><tr>
                                <td>
                                    <a href="availability">Availability</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="availability-date">Availability Date</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="shipping">Shipping</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="shipping-weight">Shipping Weight</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="shipping-label">Shipping Label</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">

                <a data-toggle="collapse" class="panelColor collapsed" data-parent="#accordion" href="#collapseSix" aria-expanded="false">

                    <div id="descriptionalAttrNav" class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-commenting-o" aria-hidden="true"></i>Descriptive
                        </h4>
                    </div>
                </a>
                <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                <div id="collapseSix" class="panel-collapse collapse" aria-expanded="false">

                    <div class="panel-body ">
                        <table class="table">
                            <tbody><tr>
                                <td>
                                    <a href="color">Color</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="gender">Gender</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="age-group">Age Group</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="material">Material</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="pattern">Pattern</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="size">Size</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="size-type">Size Type</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="size-system">Size System</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="adult">Adult</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">

                <a data-toggle="collapse" class="panelColor collapsed" data-parent="#accordion" href="#collapseSeven" aria-expanded="false">

                    <div id="additionalAttrNav" class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-plus" aria-hidden="true"></i>Others
                        </h4>
                    </div>
                </a>
                <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                <div id="collapseSeven" class="panel-collapse collapse" aria-expanded="false">

                    <div class="panel-body ">
                        <table class="table">
                            <tbody><tr>
                                <td>
                                    <a href="multipack">Multipack</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="is-bundle">Is Bundle</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="custom-label">Custom Label</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="adwords-redirect">Adwords Redirect</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="energy-efficiency-class">Energy Efficiency Class</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="excluded-destination">Excluded Destination</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="expiration-date">Expiration Date</a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>






        <div class="country">
            <div>
                <div menu__right>
                    <div class="breadcrumb"></div>
                    <h1>{{ $country->name }}  </h1>
                    <!-- TODO wenn Country Img drinnen darauf zugreifen-->
                    <img src="../assets/img/flags/flagge.png" alt="Mountain View">
                    <img src="../assets/img/flags/AUT.svg" alt="" height="20">
                    <a href="../compare" target="_self" class="btn btn-default subs-btn">Compare</a>

                    <!-- TODO klasse eindeutig benennen!!!! -->
                    <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam </p>


                    <div style="margin-left: 50px;">


                        <h2>{{$statistic_type->name}}</h2>

                        @if(count($statistic_details)<=0)
                            <p>There are no details available for this statistic type.</p>
                        @endif

                        @foreach($statistic_details as $statistic_detail)
                            <p><b>{{$statistic_detail->year}}:</b> {{$statistic_detail->value}} {{$statistic_type->type}}</p>
                            <!-- TODO create reusable templates for each value-type (f.e. top 5, %, €, ...)-->
                        @endforeach

                    </div>



                </div>
                <script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>


                <div id="chartContainer1" class="chart" ></div>
                <div id="chartContainer2" class="chart" ></div><br/>
                <div id="chartContainer3" class="chart" ></div>
                <div id="chartContainer4" class="chart" ></div>

                <script type="text/javascript">
                    var chart = new CanvasJS.Chart("chartContainer1",
                        {
                            title:{
                                text: "{{ $country->name }}",
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
                    chart.render();
                </script>
                <!-- TODO wenn Country Img drinnen darauf zugreifen-->

            </div>
        </div>
@endsection