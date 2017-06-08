@foreach($main_statistic_types as $main_statistic_type)
    <div class="statistic-menu">
        <button class="menu">{{$main_statistic_type->name}}</button>

        <!-- SUBMENU -->
        @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_type->id) as $sub_statistic_type)
            <form class="sub-statistic-type" data-statistic-type="{{$sub_statistic_type->name}}" data-country="{{ $country->id }}">
                <input type="hidden" value="{{$country->id}}" name="country_id">
                <input type="hidden" value="{{str_replace(" ", "_", $sub_statistic_type->name)}}" name="statistic_type">
                <button type="submit" class="sub_botton">
                     {{$sub_statistic_type->name}}
                </button>
            </form>

        @endforeach

        <script>

            changeCSS();

            function changeCSS () {
                console.log("dd");

                button = document.getElementsByTagName("button")
                button[6].style.backgroundColor = "#F6CE41";
                button[10].style.backgroundColor = "#F5852B";
                button[16].style.backgroundColor = "#E45D5D";
                button[21].style.backgroundColor = "#C538F4";
                button[24].style.backgroundColor = "#45A6FA";
                button[27].style.backgroundColor = "#1DE3E1";
            }
        $('.button').css("background-color", "red");
        </script>
    </div>
@endforeach