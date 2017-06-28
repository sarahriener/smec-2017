module.exports = {
    init: function () {

        $(document).ready(function() {
            // open first inner menu as default
            var $defaultStatisticMenuButton = $("div.statistic-menu").first().find('button.menu');
            var statisticType = $defaultStatisticMenuButton.data("statisticType");
            var $innerMenu = $("div." + statisticType + ".menu__inner");

            openSection($defaultStatisticMenuButton, $innerMenu);

            $innerMenu.find("button.sub_menu").first().trigger("click");
        });

        $("div.statistic-menu button.menu").on("click", function (e) {
            var $statisticMenuButton = $(this);
            var statisticType = $statisticMenuButton.data("statisticType");
            $statisticMenuButton = $('[data-statistic-type='+ statisticType + ']');

            // toggle inner menu
            var $innerMenu = $("div." + statisticType + ".menu__inner");

            if($innerMenu.is('.active')) {
                closeSection();
            } else {
                closeSection();
                openSection($statisticMenuButton, $innerMenu);
            }

            $('html, body').animate({
                scrollTop: $statisticMenuButton.offset().top
            }, 800);

        });

        $('.compare__detail__select__item').on('drop', function (e) {
            var $openStatisticMenuButton = $('div.statistic-menu button.menu.white');
            var statisticType = $openStatisticMenuButton.data("statisticType");

            $('[data-statistic-type='+ statisticType + ']').addClass('white');
        });

        function openSection($menuButton, $innerMenu) {
            $menuButton.addClass('white');
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