
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

            if ($('#div2 .filter__items__wrapper')[0]!== undefined) {
                $('.compare .filter__items')[0].append($('#div2 .filter__items__wrapper')[0]);
            }

            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));

        }
    }

};

