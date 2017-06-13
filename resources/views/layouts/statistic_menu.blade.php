
@foreach($main_statistic_types as $x => $main_statistic_type)

    <div class="statistic-menu" id="menu-type-{{$x}}">

        <button class="menu" onclick="toggle('{{$main_statistic_type->name}}')">
            <h4>{{$main_statistic_type->name}}</h4>
        </button>

        <!-- SUBMENU -->
        <div class="{{$main_statistic_type->name}} menu__inner">
            @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_type->id) as $sub_statistic_type)
                <form class="sub-statistic-type" data-statistic-type="{{$sub_statistic_type->name}}" data-country="{{ $country->id }}">
                    <input type="hidden" value="{{$country->id}}" name="country_id">
                    <input type="hidden" value="{{str_replace(" ", "_", $sub_statistic_type->name)}}" name="statistic_type">
                    <button type="submit" class="sub_button">
                         {{$sub_statistic_type->name}}
                    </button>
                </form>
                <div class="statistic-data compare-data" data-statistic-type="{{$sub_statistic_type->name}}" data-country="{{ $country->id }}"></div>
            @endforeach
        </div>
    </div>
@endforeach

        <!-- TODO falls wir eine Möglichkeit finden auch hier auf Variablen bei den Farben zugreifen-->

    <script>

        function toggle($type) {
            var button = document.getElementsByClassName($type + " menu__inner");
            $(button).each(function($i){
                if (button[$i].style.display == "inline") {
                    button[$i].style.display = "none";
                } else {
                    button[$i].style.display = "inline";
                }
            });

        }

        var button = document.getElementsByClassName("menu");
        button[0].style.backgroundColor = "#F6CE41";
        button[1].style.backgroundColor = "#F5852B";
        button[2].style.backgroundColor = "#E45D5D";
        button[3].style.backgroundColor = "#C538F4";
        button[4].style.backgroundColor = "#45A6FA";
        button[5].style.backgroundColor = "#1DE3E1";

    </script>