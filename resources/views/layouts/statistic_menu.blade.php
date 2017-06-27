
@foreach($main_statistic_types as $x => $main_statistic_type)

    <div class="statistic-menu">

        <button class="menu" data-statistic-type="{{str_replace(' ', '_', $main_statistic_type->name)}}">
            <img class="menu__img svg" src="/img/icons/{{str_replace(' ', '_', $main_statistic_type->name)}}.svg">
            <h4>{{$main_statistic_type->name}}</h4>
        </button>

        <!-- SUBMENU -->
        <div class="{{str_replace(' ', '_', $main_statistic_type->name)}} menu__inner">
            @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_type->id) as $sub_statistic_type)

                <button class="sub_menu" data-statistic-type="{{str_replace(' ', '_', $sub_statistic_type->name)}}" data-country="{{ $country->id }}">
                    {{$sub_statistic_type->name}}
                </button>

                <div class="statistic-data compare-data" data-statistic-type="{{str_replace(' ', '_', $sub_statistic_type->name)}}" data-country="{{ $country->id }}"></div>

            @endforeach
        </div>
    </div>
@endforeach