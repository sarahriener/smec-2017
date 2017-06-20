module.exports = {
    init: function () {

        $("div.statistic-menu button.menu").on("click", function (e) {
            var $statisticMenu = $(this);

            $('html, body').animate({
               scrollTop: $statisticMenu.offset().top - 100
            }, 800);

            var statistic_type = $statisticMenu.data("statisticType");

            // hide all
            var statistic_type_divs = $("div.menu__inner");
            $(statistic_type_divs).each(function (i) {
                statistic_type_divs[i].style.display = "none";
            });

            // toggle
            var statistic_type_div = $("div." + statistic_type + ".menu__inner");
            $(statistic_type_div).each(function (i) {

                if (statistic_type_div[i].style.display == "inline") {
                    statistic_type_div[i].style.display = "none";
                } else {
                    statistic_type_div[i].style.display = "inline";
                }
            });
        });

        /*var button = $("div.statistic-menu button.menu");

        if (button.length > 0) {
            //button[0].style.backgroundColor = "#F6CE41";
            //button[1].style.backgroundColor = "#F5852B";
            //button[2].style.backgroundColor = "#E45D5D";
            //button[3].style.backgroundColor = "#C538F4";
            //button[4].style.backgroundColor = "#45A6FA";
            //button[5].style.backgroundColor = "#1DE3E1";
        }*/

    }
};