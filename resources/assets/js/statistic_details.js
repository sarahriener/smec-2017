
module.exports = {
    init: function () {
        if($('#div2').not('div.filter__items__wrapper')){
            $('#data-div2').hide();
            $('#data-div2').find('div.statistic-data.compare-data').each(function(){
                (this).setAttribute('data-country', null);
            });
        }

        $('.compare__detail__select__item').on('drop', function(e){
            var country_id = $(e.target).find('.filter__items__wrapper')[0].id;
            var country_div_2 =  $('#data-div2');

            country_div_2.find('button.sub_menu').each(function(){
                var curr = this;
                curr.setAttribute('data-country', country_id); // update country id in button

                $(curr).next()[0].setAttribute('data-country', country_id); // update country id in div
            });
            country_div_2.show();
        });


        $("div.statistic-menu button.sub_menu").on("click", function(e){
            var type = e.target;
            var sub_statistic_type = $(type).data("statisticType");
            var sub_menu = $(".statistic-menu").find("button.sub_menu[data-statistic-type='" + sub_statistic_type + "']") ;

            $(sub_menu).each(function(i){ // both countries
                var country_id = $(sub_menu[i]).data("country");
                var statistic_type = $(sub_menu[i]).data("statisticType");

                $.ajax({ // ask for data and add to div
                    type: 'GET',
                    url: '/getStatisticDetails',
                    data: {
                        country_id: country_id,
                        statistic_type: statistic_type},
                    success: function(data) {
                        hideAllDetails(data['country']);
                        showDetails(data);
                    }
                });
            });

        });

        function hideAllDetails(country){
            var statistic_detail_div = $('div.statistic-data[data-country="' + country.id + '"]');
            statistic_detail_div.empty();
        }

        function showDetails(data){
            var country = data['country'];
            var statistic_type = data['statistic_type'];
            var statistic_details = data['statistic_details'];

            var statistic_detail_div = $('div.statistic-data.detail-data[data-country="' + country.id + '"]');

            var isCompare = window.location.href.includes('compare');
            if(isCompare){

                statistic_detail_div = $('div' +
                    '.statistic-data' +
                    '.compare-data' +
                    '[data-country="' + country.id + '"]' +
                    '[data-statistic-type="' + statistic_type.name.replace(" ", "_") + '"]');
            }

            //insert data
            if(statistic_details.length <= 0){ // no date available
                if(isCompare){
                    $(statistic_detail_div).html(
                        '<p>There are no details available for this statistic type.</p>');
                } else{
                    $(statistic_detail_div).html(
                        '<h2>' + statistic_type.name + '</h2>' +
                        '<p>There are no details available for this statistic type.</p>');
                }
            } else{
                var statistic_detail_data = '<div id="chartContainer-'+ statistic_type.name + '" class="chart" ></div>';

                if(isCompare){
                    $(statistic_detail_div).html(statistic_detail_data);
                } else{
                    $(statistic_detail_div).html(
                        '<h2>' + statistic_type.name + '</h2>' +
                        statistic_detail_data);
                }

                generate_statistic_data(statistic_details, statistic_type);
            }
        }

        function generate_statistic_data(statistic_details, statistic_type){
            var statistic_detail_data = '';

            /** TODO fallunterscheidung: Um welche Statistikart handelt es sich (es ist bereits definiert welche
             *  statistic_types welche arten von Graphen eingefügt werden sollen!!
             *  */
            // Hier beispiel eines column charts (population) -- nachher besser mit case!
            //if(statistic_type.name == "Population"){
            createColumnChart(statistic_details, statistic_type);
            //}

            return statistic_detail_data;
        }

        function createColumnChart(statistic_details, statistic_type){

            var generatedDataPoints = [];

            var data_value = "";
            $(statistic_details).each(function(i, detail){
                var year =  detail.year;
                var value =  detail.value;


                var data = {};

                data_value = parseFloat(value.replace(/[^0-9\.]/g, ''));
                data.x =  year;
                data.y =  data_value;
                data.label = year;

                generatedDataPoints.push(data);

            });
            var chart = new CanvasJS.Chart('chartContainer-'+ statistic_type.name + '',
                {
                    animationEnabled: true,
                    title: {
                        text: statistic_type.name,
                        fontFamily: "arial"
                    },
                    legend: {
                        fontFamily: "arial"
                    },
                    axisX: {
                        interval: (data_value/100)
                    },
                    data: [
                        {
                            type: "column",
                            legendMarkerType: "triangle",
                            legendMarkerColor: "green",
                            color: "rgba(255,12,32,.3)",
                            showInLegend: true,
                            legendText: statistic_type.description,
                            dataPoints: generatedDataPoints
                        }
                    ]
                });
            chart.render();
        }

    }
};