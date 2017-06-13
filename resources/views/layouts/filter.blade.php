<div class="filter">
    <div class="filter__search">
        <label class="filter__search__label">
            <span class="filter__search__span">Choose a region or country</span>
            <select id="select__country" class="js-example-basic-single form-control filter__search__search">
                <option value="null" title="all">All</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->code }}" title="{{$country->name}}">{{ $country->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="filter__tags">
        <button type="button" class="filter__tag" data-continent="null">All</button>
        @foreach ($continents as $continent)
            <button class="filter__tag" data-continent="{{$continent->id}}">{{ $continent->name }}</button>
        @endforeach
    </div>

    <div class="filter__items" ondrop="drop(event)" ondragover="allowDrop(event)">
        @foreach ($countries as $country)
            <div class="filter__items__wrapper" id="{{ $country->id }}" draggable="true" ondragstart="drag(event)">
                <a href="/country/{{$country->id}}" class="filter__item filter__country" data-country="{{ $country->code }}" data-continent="{{$country->continent_id}}">
                    {{ $country->name }}
                    <div class="filter__items__imagediv">
                        <img class="filter__items__img" src="/img/flags/{{$country->code}}.svg">
                    </div>
                </a>

            </div>
        @endforeach
    </div>

</div>