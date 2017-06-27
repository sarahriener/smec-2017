module.exports = {
    init: function () {

        $("div.statistic-menu button.menu").on("click", function (e) {
            var $statisticMenu = $(this);
            var statistic_type = $statisticMenu.data("statisticType");

            // toggle
            var $innerMenu = $("div." + statistic_type + ".menu__inner");

            if($innerMenu.is('.active')) {
                closeSection();
            } else {
                closeSection();
                $innerMenu.addClass('active');
                $innerMenu.parent().find('.menu').addClass('white');
                $innerMenu.slideDown(300).addClass('open');
            }

            $('html, body').animate({
                scrollTop: $statisticMenu.offset().top
            }, 800);

            function closeSection() {
                $('div.menu__inner').removeClass('active');
                $('div.menu__inner').parent().find('.menu').removeClass('white');
                $('div.menu__inner').slideUp(300).removeClass('open');
            }
        });
        
    }
};