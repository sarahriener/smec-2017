module.exports = {
    init: function () {

        if($('#div2').not('div.filter__items__wrapper')){
            $('#data-div2').hide();
            $('#data-div2').find('div.statistic-data.compare-data').each(function(){
                (this).setAttribute('data-country', null);
            });

            $('#data-div2').find('button.sub_menu').each(function(){
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

            hideAllDetails(country_id);

            var sub_menu = $("#data-div1 .statistic-menu").find("button.sub_menu");
            hideAllDetails($(sub_menu[0]).data("country"));

            country_div_2.show();
        });

        initMenu();

        function initMenu(){
            $("div.statistic-menu button.sub_menu").on("click", function(e){
                var type = e.target;
                var sub_statistic_type = $(type).data("statisticType");
                var sub_menu = $(".statistic-menu").find("button.sub_menu[data-statistic-type='" + sub_statistic_type + "']");

                var isCompare = window.location.href.includes('compare');
                var isOpen = false;

                if(isCompare) {
                    var statistic_detail_div = $(type).next();
                    isOpen = $(statistic_detail_div).children().length > 0;
                }
                if(isOpen){
                    hideAllDetails($(sub_menu[0]).data("country"));
                    hideAllDetails($(sub_menu[1]).data("country"));
                } else{
                    $(sub_menu).each(function(i){ // both countries
                        var statistic_type = $(sub_menu[i]).data("statisticType");
                        var country_id = $(sub_menu[i])[0].getAttribute("data-country");
                        if(country_id != "null"){

                            $.ajax({ // ask for data and add to div
                                type: 'GET',
                                url: '/getStatisticDetails',
                                data: {
                                    country_id: country_id,
                                    statistic_type: statistic_type
                                },
                                success: function(data) {
                                    hideAllDetails(data['country'].id);
                                    generateCharts(data);
                                }
                            });

                        }
                    });
                }
            });
        }

        function hideAllDetails(country_id){
            var statistic_detail_div = $('div.statistic-data[data-country="' + country_id + '"]');
            statistic_detail_div.empty();
        }

        function generateCharts(data){
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
                    '[data-statistic-type="' + statistic_type.name.split(' ').join('_') + '"]');

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

                var statistic_detail_data = '<div class="chart"><canvas id="chartContainer-'+ statistic_type.name.split(' ').join('_') + '_' + country.id + '"></canvas></div>';

                if(isCompare){
                    $(statistic_detail_div).html(statistic_detail_data);
                } else{
                    var statisticTypeExplanation = statistic_type.explanation ? statistic_type.explanation : '';

                    $(statistic_detail_div).html(
                        '<h2>' + statistic_type.name + '</h2>' +
                        '<p>' + statisticTypeExplanation + '</p>' +
                        statistic_detail_data);
                }

                generate_statistic_data(statistic_details, statistic_type, country.id);
            }
        }

        function generate_statistic_data(statistic_details, statistic_type, country_id){
            var Chart = require('chart.js');

            var detail_div = document.getElementById('chartContainer-'+ statistic_type.name.split(' ').join('_') + '_' + country_id);
            var ctx = detail_div.getContext("2d");


            switch(statistic_type.type) {
                case "inhabitants":
                    var data = createDataForChart(statistic_details);
                    createBarChart(data, ctx, statistic_type);
                    break;
                case "€":
                case "$":
                    //TODO einfach anzeigen
                    break;
                case "top":
                    createRanking(detail_div, statistic_type);
                    break;

                case "%":
                case "years":
                    var data = createDataForChart(statistic_details);
                    createDoughnutChart(data, ctx, statistic_type);
                    break;

                default:
                    var data = createDataForChart(statistic_details);
                    createBarChart(data, ctx, statistic_type);
            }
        }

        function createDataForChart(statistic_details){
            var generatedDataPoints = [];
            var generatedDataLabels = [];

            $(statistic_details).each(function(i, detail){
                var year =  detail.year;
                var value =  detail.value;
                var data_value = parseFloat(value.replace(/[^0-9\.]/g, ''));

                generatedDataPoints.push(data_value);
                generatedDataLabels.push(year.toString());

            });
            var data = {};
            data.generatedDataPoints = generatedDataPoints;
            data.generatedDataLabels = generatedDataLabels;

            return data;
        }

        function createRanking(detail_div, statistic_type){
            var country_id = statistic_type.pivot.country_id;

            $.ajax({ // ask for data and add to div
                type: 'GET',
                url: '/getStatisticTypeSubTypes',
                data: {
                    statistic_type_id: statistic_type.id
                },
                success: function(statisticTypeSubTypes) {
                    var subTypes = statisticTypeSubTypes;
                    var rankings = [];

                    $.each(subTypes, function( i, subType ){
                        $.ajax({ // ask for data and add to div
                            type: 'GET',
                            url: '/getStatisticDetails',
                            data: {
                                country_id: country_id,
                                statistic_type: subType.name
                            },
                            success: function(data){
                                rankings.push(data);
                                if(rankings.length == Object.keys(subTypes).length){
                                    var sorted_detail_array = [];
                                    $.each(rankings, function(i, ranking) {
                                        sorted_detail_array[ranking.statistic_type.name] = ranking.statistic_details[0];
                                    });
                                    var keys = Object.keys(sorted_detail_array).sort();

                                    var detail_string = "";
                                    $.each(keys, function(i, name) {
                                        detail_string += "<p><b>" + name + "</b>: ";
                                        detail_string +=  sorted_detail_array[name].value + " (" + sorted_detail_array[name].year + ") " + "</p>";

                                    });
                                    $(detail_div).parent().html(detail_string);
                                }
                            }
                        });
                    });

                }
            });
        }

        function createDoughnutChart(data, ctx, statistic_type){
            var doughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.generatedDataLabels,
                    datasets: [{
                        label: statistic_type.name,
                        data: data.generatedDataPoints,
                        backgroundColor: [
                            'rgba(54, 162, 235,1)',
                            'rgba(255, 206, 86,1)',
                            'rgba(255, 99, 132,1)',
                            'rgba(75, 192, 192,1)',
                            'rgba(153, 102, 255,1)',
                            'rgba(255, 159, 64,1)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: statistic_type.description
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    maintainAspectRatio: false
                }
            });
        }

        function createBarChart(data, ctx, statistic_type){
            var barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.generatedDataLabels,
                    datasets: [{
                        label: statistic_type.name,
                        data: data.generatedDataPoints,
                        backgroundColor: [
                            'rgba(54, 162, 235,1)',
                            'rgba(255, 206, 86,1)',
                            'rgba(75, 192, 192,1)',
                            'rgba(255, 99, 132,1)',
                            'rgba(153, 102, 255,1)',
                            'rgba(255, 159, 64,1)'
                        ]
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: statistic_type.description
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    }
};