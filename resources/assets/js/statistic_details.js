

module.exports = {

    init: function () {

        if($("#div2").not("div.filter__items--wrapper")){
            $("#data-div2").hide();
        }


        $("form.sub-statistic-type").submit(function(e) {
            $.ajax({
                type: "GET",
                url: "/getStatisticDetails",
                data: $(this).serialize(), // serializes the form's elements.
                success: function(data) {
                    showDetails(data);
                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


        $(".compare__detail__select--item").on("drop", function(e){
           var country_elem = e.target;

            var country_id = $(country_elem).find(".filter__items--wrapper")[0].id;

            $("#data-div2").find("form.sub-statistic-type").find("input[name='country_id']").val(country_id);
            $("#data-div2").show();

        });

        function showDetails(data){
            var country = data['country'];
            var statistic_type = data['statistic_type'];
            var statistic_details = data['statistic_details'];

            var statistic_detail_div = $("div.statistic_type[data-country='" + country.id + "'] ");

            if(statistic_detail_div){
                var statType = $('<div class="statistic_type" data-statistic-type="' + statistic_type.name +'" data-country="' + country.id + '">');

                var insertType = $("form[data-country='" + country.id + "'][data-statistic-type='" + statistic_type.name + "']");

                insertType.after(statType);
            }

            if(statistic_detail_div.data("statisticType")){
                statistic_detail_div = $("div[data-country='" + country.id + "'][data-statistic-type='" + statistic_type.name + "']");
            }

            if(statistic_details.length <= 0){
                $(statistic_detail_div).html(
                    "<h2>" + statistic_type.name + "</h2>" +
                    "<p>There are no details available for this statistic type.</p>");
            }
            else{
                $(statistic_details).each(function(i, detail){
                    var year =  detail.year;
                    var value =  detail.value;

                    $(statistic_detail_div).html(
                        "<h2>" + statistic_type.name + "</h2>" +
                        "<div><b>" + year + ":</b> " + value + "</div>");

                });
            }

        }

    }
};