
module.exports = {
    init: function () {
        if($('#div2').not('div.filter__items__wrapper')){
            $('#data-div2').hide();
            $('#data-div2').find('div.statistic-data.compare-data').each(function(){
                (this).setAttribute('data-country', null);
            });
        }

        $('.compare__detail__select__item').on('drop', function(e){
           var country_elem = e.target;

            var country_id = $(country_elem).find('.filter__items__wrapper')[0].id;

            var country_div_2 =  $('#data-div2');
            country_div_2.find('form.sub-statistic-type').find('input[name="' + country_id + '"]').val(country_id);
            country_div_2.show();

        });

        $('form.sub-statistic-type').submit(function(e) {
            $.ajax({
                type: 'GET',
                url: '/getStatisticDetails',
                data: $(this).serialize(), // serializes the form's elements.
                success: function(data) {
                    hideAllDetails(data['country']);
                    showDetails(data);
                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
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
                    '[data-statistic-type="' + statistic_type.name + '"]');
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