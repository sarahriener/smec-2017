@foreach($main_statistic_types as $main_statistic_type)
    <div class="statistic-menu">

        <button class="menu" onclick="toggle()" for="toggle-1"><h4>{{$main_statistic_type->name}}</h4></button>

        <!-- SUBMENU -->
        <div class="menu__inner">
        @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_type->id) as $sub_statistic_type)

            <form class="sub-statistic-type" data-statistic-type="{{$sub_statistic_type->name}}" data-country="{{ $country->id }}">
                <input type="hidden" value="{{$country->id}}" name="country_id">
                <input type="hidden" value="{{str_replace(" ", "_", $sub_statistic_type->name)}}" name="statistic_type">
                <button type="submit" class="sub_button">
                     {{$sub_statistic_type->name}}
                </button>
            </form>
        @endforeach
        </div>
    </div>
     <script>

         function toggle() {
             var button = document.getElementsByClassName("menu__inner");
             if (button[0].style.display == "inline") {
                 button[0].style.display = "none";
             }
             else {
                 button[0].style.display = "inline";
             }
         }

    </script>
@endforeach