
@foreach($main_statistic_types as $x => $main_statistic_type)

    <div class="statistic-menu">

        <button class="menu" data-statistic-type="{{$main_statistic_type->name}}">
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