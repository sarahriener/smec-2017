
module.exports = {

    init: function () {
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();

            var $dropLength = $('#div2 .filter__items--wrapper').length;

            console.log('???');
            if ($dropLength > 0) {
                var $toShift = $('#div2 .filter__items--wrapper')[0];

                var $insert = $('.compare .filter__items');
                $insert.appendChild($toShift);
                $toShift.remove();
            }


            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));

        }

    }

};

