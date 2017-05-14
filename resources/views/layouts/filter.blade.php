<div class="filter">
    <div class="filter__search">
        <label>
            <span>Choose a Region or</span>
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
</div>