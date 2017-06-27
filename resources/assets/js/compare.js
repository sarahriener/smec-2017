

module.exports = {

    init: function () {

        $(function(){
            var pathname = window.location.pathname;

            if(pathname.includes('/compare/')) {
                var id = getLeftSideCountryId(pathname);

                $('.filter__items__wrapper#' + id).hide();
            }

            function getLeftSideCountryId(pathname) {
                return pathname.split('/').filter(function(n){ return n != "" })[1];
            }

        });

    }
};