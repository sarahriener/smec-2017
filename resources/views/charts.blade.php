/**
 * Created by manuela_posch on 03.05.17.
 */
@extends('layouts.app')

@section('title', 'Charts')

<div id="chartContainer" style="height: 300px; width: 100%;">
</div>

<script type="text/javascript">

window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer",
{
title:{
text: "US Mobile / Tablet OS Market Share, Dec 2012"
},
animationEnabled: true,
theme: "theme2",
data: [
{
type: "doughnut",
indexLabelFontFamily: "Garamond",
indexLabelFontSize: 20,
startAngle:0,
indexLabelFontColor: "dimgrey",
indexLabelLineColor: "darkgrey",
toolTipContent: "{y} %",

dataPoints: [
{  y: 67.34, indexLabel: "iOS {y}%" },
{  y: 28.6, indexLabel: "Android {y}%" },
{  y: 1.78, indexLabel: "Kindle {y}%" },
{  y: 0.84,  indexLabel: "Symbian {y}%"},
{  y: 0.74, indexLabel: "BlackBerry {y}%" },
{  y: 2.06,  indexLabel: "Others {y}%"}

]
}
]
});

chart.render();
}
</script>

@section('charts')

@endsection