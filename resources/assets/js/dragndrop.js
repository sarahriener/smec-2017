
module.exports = {

    init: function () {

        $(document).ready(function () {

            $('#div1').addEventListener("drop", drop(event));
            $('#div2').addEventListener("drop", drop(event));

            $('#div1').addEventListener("dragover", allowDrop(event));
            $('#div2').addEventListener("dragover", allowDrop(event));

            $('.filter__items--item.draggable').addEventListener("dragstart", drag(event));

        });


        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }

    }
};