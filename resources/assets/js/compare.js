

module.exports = {

    init: function () {

        $(document).ready(function () {

        });

        $("form.statistic-type").submit(function(e) {

            var url = "/getStatisticDetails"; // the script where you handle the form input.

            var curr_div = this;

            $.ajax({
                type: "GET",
                url: url,
                data: $(this).serialize(), // serializes the form's elements.
                success: function(statistic_subtypes)
                {
                    $(statistic_subtypes).each(function(i, statistic_subtype){
                        console.log(statistic_subtype);
                    });
                    $(curr_div).append("<div>" + statistic_subtypes + "</div>");
                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });





    }
};