
module.exports = {
    init: function () {
        $(document).ready(function () {

            // show draggable slider items on compare
            let $wrapper = document.getElementsByClassName('compare')[0];

            if ($wrapper != undefined) {
                let $dragTrue = $wrapper.querySelector('#dragTrue');
                let $dragFalse = $wrapper.querySelector('#dragFalse');

                $dragTrue.style.display = 'inline-block';
                $dragFalse.style.display = 'none';
            }


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