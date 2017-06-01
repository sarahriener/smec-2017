@foreach($main_statistic_types as $main_statistic_type)
    <div class="statistic-menu">
        <button class="menu">{{$main_statistic_type->name}}</button>

        <!-- SUBMENU -->
        @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_type->id) as $sub_statistic_type)
            <form class="sub-statistic-type">
                <input type="hidden" value="{{$country->id}}" name="country_id">
                <input type="hidden" value="{{str_replace(" ", "_", $sub_statistic_type->name)}}" name="statistic_type">
                <button type="submit" class="menu">
                    - {{$sub_statistic_type->name}}
                </button>
            </form>

        @endforeach

    </div>
@endforeach