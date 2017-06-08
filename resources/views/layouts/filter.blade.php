<div class="filter">
    <div class="filter__search">
        <label class="filter__search--label">
            <span class="filter__search--span">Choose a region or country</span>
            <select class="js-example-basic-single form-control filter__search--search">
                <option value="null" title="all">All</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->code }}" title="{{$country->name}}">{{ $country->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="filter__tags">
        <button type="button" class="filter__tags--tag" data-continent="null">All</button>
        @foreach ($continents as $continent)
            <button class="filter__tags--tag" data-continent="{{$continent->id}}">{{ $continent->name }}</button>
        @endforeach
    </div>

    <div class="filter__items" ondrop="drop(event)" ondragover="allowDrop(event)">
        @foreach ($countries as $country)
            <div class="filter__items--wrapper" id="{{ $country->id }}" draggable="true" ondragstart="drag(event)">
                <a href="/country/{{$country->id}}" class="filter__items--item" class="filter__country" data-country="{{ $country->code }}" data-continent="{{$country->continent_id}}">{{ $country->name }}</a>
            </div>
        @endforeach
    </div>

</div>