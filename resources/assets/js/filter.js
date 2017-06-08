//var $ = require('jquery');
//var jQuery = $;

// TODO require jquery, select2 and bootstrap instead of link and script tags above
//var select2BootstrapTheme = require('select2-bootstrap-theme');


module.exports = {
    init: function () {
        $(document).ready(function () {
            let $selectCountry = $(".filter__search .js-example-basic-single");
            $selectCountry.select2({
                templateResult: formatState,
                templateSelection: formatState
            });

            $selectCountry.on("select2:select", function (e) {
                let $currCountry = $(e.currentTarget).find("option:selected").val();
                filterCountries("country", $currCountry);
            });

            let $selectContinent = $(".filter__tags .filter__tags--tag");
            $selectContinent.on("click", function(e){
                let $currContinent = $(e.currentTarget).data("continent");

                filterCountries("continent", $currContinent);

            });
        });

        function filterCountries($filterBy, $val){
            let $countryItems = $('.filter__items--item');

            for (let i = 0; i < $countryItems.length; i++) {
                let $filterVal = $($countryItems[i]).data($filterBy);

                if($val == "null" || !$val){
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
                '<span><img width="30px"  height="auto" src="https://c.tadst.com/gfx/n/fl/128/at.png" class="img-flag" /> ' + country.text + '</span>'
                // TODO add Flag images
                // '<span><img src="vendor/imgs/flags/' + country.id.toLowerCase() + '.png" class="img-flag" /> ' + country.title + '</span>'
            );
            return countryOption;
        }
    }
};