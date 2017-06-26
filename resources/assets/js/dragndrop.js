module.exports = {

    init: function () {
        $('#div2').on('drop', drop);
        $('#div2').on('dragover', drop);
        $('.filter__items').on('drop', drop);
        $('.filter__items').on('dragover', drop);

        $('.filter__items__wrapper').each(function () {
            $(this).on('dragstart', drag);
            $(this).find('a').on('dragstart', drag);
        });

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            var $target = $(ev.target);
            var targetId = 0;

            if ($target.hasClass("filter__items__wrapper")) {
                targetId = ev.target.id;
            } else {
                targetId = $target.closest(".filter__items__wrapper").attr('id');
            }

            ev.originalEvent.dataTransfer.setData("countryId", targetId);
        }

        function drop(ev) {
            ev.preventDefault();

            var $target = $(ev.target);

            var $rightCountryCompare = $('#div2 .filter__items__wrapper');

            if ($rightCountryCompare[0] !== undefined) {
                $('.compare .filter__items')[0].append($rightCountryCompare[0]);
            }

            var countryId = ev.originalEvent.dataTransfer.getData("countryId");

            if (countryId) {
                ev.target.appendChild(document.getElementById(countryId));

                var $close = $target.find('.close');

                if ($close.length == 0) {
                    addCloseButton($target);
                }
            }
        }

        function addCloseButton($target) {
            $target.append('<span class="close">x</span>');

            var $close = $target.find('.close');

            $close.bind('click', function () {
                $close.remove();
                $('#data-div2.compare__detail__data__item').hide();

                var countryId = $target.find('.filter__items__wrapper')[0].id;
                $('.filter__items').append($('#' + countryId));
            });
        }
    }

};


