//var $ = require('jquery');
//var jQuery = $;

// TODO require jquery, select2 and bootstrap instead of link and script tags above
//var select2BootstrapTheme = require('select2-bootstrap-theme');


module.exports = {
    init: function () {
            let $selectCountry = $(".filter__search .filter__search__search");
            $selectCountry.select2({
                templateResult: formatState,
                templateSelection: formatState
            });

            $selectCountry.on("select2:select", function (e) {
                let $currCountry = $(e.currentTarget).find("option:selected").val();
                filterCountries("country", $currCountry);
            });

            let $selectContinent = $(".filter__tags .filter__tag");
            $selectContinent.on("click", function(e){
                let $currContinent = $(e.currentTarget).data("continent");

                // reset select if region is chosen -- not working yet
                //$('select__country option:first-child').attr("selected", "selected");

                $("#select__country option:selected").val($("#target option:first").val());

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