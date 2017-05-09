//var $ = require('jquery');
//var jQuery = $;

// TODO require jquery, select2 and bootstrap instead of link and script tags above
//var select2BootstrapTheme = require('select2-bootstrap-theme');


module.exports = {
    init: function () {
        $(document).ready(function () {
            let $selectBox = $(".js-example-basic-single");
            $selectBox.select2({
                templateResult: formatState,
                templateSelection: formatState
            });

            $selectBox.on("select2:select", function (event) {
                let $valSelected = $(event.currentTarget).find("option:selected").val();

                let $contentItems = $('.content__items--item');

                for (var i = 0; i < $contentItems.length; i++) {
                    if ($contentItems[i].dataset.value !== $valSelected) {
                        $($contentItems[i]).hide();
                    } else {
                        $($contentItems[i]).show();
                    }
                }
            });
        });

        function formatState(country) {
            if (!country.id) {
                return country.text;
            }
            var option = $(
                '<span><img width="30px"  height="auto" src="https://c.tadst.com/gfx/n/fl/128/at.png" class="img-flag" /> ' + country.text + '</span>'
                // TODO add Flag images
                // '<span><img src="vendor/imgs/flags/' + country.id.toLowerCase() + '.png" class="img-flag" /> ' + country.title + '</span>'
            );
            return option;

        }
    }
};