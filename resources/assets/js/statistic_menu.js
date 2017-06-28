module.exports = {
    init: function () {

        $(document).ready(function() {
            // open first inner menu as default
            var $defaultStatisticMenuButton = $("div.statistic-menu").first().find('button.menu');
            var statisticType = $defaultStatisticMenuButton.data("statisticType");

            var $innerMenu = $("div." + statisticType + ".menu__inner");
            openSection($innerMenu);
            $innerMenu.find("button.sub_menu").first().trigger("click");
        });

        $("div.statistic-menu button.menu").on("click", function (e) {
            var $statisticMenuButton = $(this);
            var statisticType = $statisticMenuButton.data("statisticType");

            // toggle inner menu
            var $innerMenu = $("div." + statisticType + ".menu__inner");

            if($innerMenu.is('.active')) {
                closeSection();
            } else {
                closeSection();
                $statisticMenuButton.addClass('white');
                openSection($innerMenu);

                $innerMenu.find("button.sub_menu").first().trigger("click");
            }

            $('html, body').animate({
                scrollTop: $statisticMenuButton.offset().top
            }, 800);

        });

        function openSection($innerMenu) {
            $innerMenu.addClass('active');
            $innerMenu.slideDown(300).addClass('open');
        }

        function closeSection() {
            $('div.statistic-menu button.menu').removeClass('white');
            $('div.menu__inner').removeClass('active');
            $('div.menu__inner').slideUp(300).removeClass('open');
        }
        
    }
};