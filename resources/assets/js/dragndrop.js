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
            console.log("drop on target", ev.target);

            if ($('#div2 .filter__items__wrapper')[0] !== undefined) {
                $('.compare .filter__items')[0].append($('#div2 .filter__items__wrapper')[0]);
            }

            var data = ev.originalEvent.dataTransfer.getData("countryId");
            console.log("drop of data", data);
            ev.target.appendChild(document.getElementById(data));
        }
    }

};

