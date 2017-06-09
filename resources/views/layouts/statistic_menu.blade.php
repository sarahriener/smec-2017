@for($x = 0; $x < count($main_statistic_types); $x++)

    <div class="statistic-menu" id="menu-type-{{$x}}">

        <button class="menu" onclick="toggle({{$x}})">
            <h4>{{$main_statistic_types[$x]->name}}</h4>
        </button>

        <!-- SUBMENU -->
        <div class="menu__inner">
            @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_types[$x]->id) as $sub_statistic_type)
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
@endfor

        <!-- TODO falls wir eine Möglichkeit finden auch hier auf Variablen bei den Farben zugreifen-->

    <script>

        function toggle($i) {
            var button = document.getElementById('menu-type-' + $i).getElementsByClassName("menu__inner");
            if (button[0].style.display == "inline") {
                button[0].style.display = "none";
            } else {
                button[0].style.display = "inline";
            }
        }

        var button = document.getElementsByClassName("menu");
        button[0].style.backgroundColor = "#F6CE41";
        button[1].style.backgroundColor = "#F5852B";
        button[2].style.backgroundColor = "#E45D5D";
        button[3].style.backgroundColor = "#C538F4";
        button[4].style.backgroundColor = "#45A6FA";
        button[5].style.backgroundColor = "#1DE3E1";

    </script>