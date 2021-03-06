module.exports = {
    init: function () {
            let $selectCountry = $(".filter__search .filter__search__search");
            $selectCountry.select2({
                templateResult: formatState,
                templateSelection: formatState
            });

            $selectCountry.on("select2:select", function (e) {
                $(".filter__tags .filter__tag").removeClass('selected');
                let $currCountry = $(e.currentTarget).find("option:selected").val();
                filterCountries("country", $currCountry);
            });

            let $selectContinent = $(".filter__tags .filter__tag");
            $selectContinent.on("click", function(e){
                $(".filter__tags .filter__tag").removeClass('selected');
                $(e.currentTarget).addClass('selected');
                let $currContinent = $(e.currentTarget).data("continent");

                // reset select if region is chosen
                $($selectCountry).val('ALL').trigger('change');

                filterCountries("continent", $currContinent);

            });

        function filterCountries($filterBy, $val){
            let $countryItems = $('.filter__item');

            for (let i = 0; i < $countryItems.length; i++) {
                let $filterVal = $($countryItems[i]).data($filterBy);

                if($val == "ALL" || !$val){
                    $($countryItems[i]).parent().removeClass('hide');
                } else if ($filterVal !== $val) {
                    $($countryItems[i]).parent().addClass('hide');
                } else {
                    $($countryItems[i]).parent().removeClass('hide');
                }
            }
        }

        function formatState(country) {
            if (!country.id) {
                return country.text;
            }
            let countryOption = $(
                '<span><img height="25" src="/img/flags/' + country.id +'.svg" class="img-flag" /> ' + country.text + '</span>'
            );
            return countryOption;
        }
    }
};