/**
* Created by manuela_posch on 03.05.17.
*/
@extends('layouts.app')

@section('title', 'Charts')

@section('charts')


    <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">

        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                title:{
                    text: "My First Chart in CanvasJS"
                },
                data: [
                    {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "splineArea",
                        dataPoints: [
                            { label: "apple",  y: 10  },
                            { label: "orange", y: 15  },
                            { label: "banana", y: 25  },
                            { label: "mango",  y: 30  },
                            { label: "grape",  y: 28  }
                        ]
                    }
                ]
            });
            chart.render();
        }
    </script>
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>

@endsection