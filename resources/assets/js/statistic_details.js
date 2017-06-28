module.exports = {
    init: function () {

        if ($('#div2').not('div.filter__items__wrapper')) {
            $('#data-div2').hide();
            $('#data-div2').find('div.statistic-data.compare-data').each(function () {
                (this).setAttribute('data-country', null);
            });

            $('#data-div2').find('button.sub_menu').each(function () {
                (this).setAttribute('data-country', null);
            });
        }

        $('.compare__detail__select__item').on('drop', function (e) {
            var country_id = $(e.target).find('.filter__items__wrapper')[0].id;
            var country_div_2 = $('#data-div2');

            country_div_2.find('button.sub_menu').each(function () {
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

        function initMenu() {
            $("div.statistic-menu button.sub_menu").on("click", function (e) {
                var type = e.target;
                $("div.statistic-menu button.sub_menu").removeClass('selected');
                $(this).addClass('selected');

                var sub_statistic_type = $(type).data("statisticType");
                var sub_menu = $(".statistic-menu").find("button.sub_menu[data-statistic-type='" + sub_statistic_type + "']");

                var isCompare = window.location.href.includes('compare');
                var isOpen = false;

                if (isCompare) {
                    var statistic_detail_div = $(type).next();
                    isOpen = $(statistic_detail_div).children().length > 0;
                }
                if (isOpen) {
                    hideAllDetails($(sub_menu[0]).data("country"));
                    hideAllDetails($(sub_menu[1]).data("country"));
                } else {
                    $(sub_menu).each(function (i) { // both countries
                        var statistic_type = $(sub_menu[i]).data("statisticType");
                        var country_id = $(sub_menu[i])[0].getAttribute("data-country");

                        if (country_id != "null") {

                            $.ajax({ // ask for data and add to div
                                type: 'GET',
                                url: '/getStatisticDetails',
                                data: {
                                    country_id: country_id,
                                    statistic_type: statistic_type
                                },
                                success: function (data) {
                                    hideAllDetails(data['country'].id);
                                    generateCharts(data);
                                }
                            });

                        }
                    });
                }
            });
        }

        function hideAllDetails(country_id) {
            var statistic_detail_div = $('div.statistic-data[data-country="' + country_id + '"]');
            statistic_detail_div.empty();
        }

        function generateCharts(data) {
            var country = data['country'];
            var statistic_type = data['statistic_type'];
            var statistic_details = data['statistic_details'];

            var statistic_detail_div = $('div.statistic-data.detail-data[data-country="' + country.id + '"]');


            var isCompare = window.location.href.includes('compare');
            if (isCompare) {
                statistic_detail_div = $('div' +
                    '.statistic-data' +
                    '.compare-data' +
                    '[data-country="' + country.id + '"]' +
                    '[data-statistic-type="' + statistic_type.name.split(' ').join('_') + '"]');
            }

            // if mobile: insert data after heading
            var mq = window.matchMedia( "(max-width: 767px)" );
            if (mq.matches) {
                statistic_detail_div = $('div' +
                    '.statistic-data' +
                    '.compare-data' +
                    '[data-country="' + country.id + '"]' +
                    '[data-statistic-type="' + statistic_type.name.split(' ').join('_') + '"]');
            }

            //insert data
            if (!statistic_details) { // no date available
                if (isCompare) {
                    $(statistic_detail_div).html(
                        '<div class="alert alert-info">Oops! There are no details available for this statistic type.</div>');
                } else {
                    $(statistic_detail_div).html(
                        '<h2>' + statistic_type.name + '</h2>' +
                        '<div class="alert alert-info">Oops! There are no details available for this statistic type.</div>');
                }
            } else {
                var statistic_detail_data = '<div class="chart"><div class="canvas-container">' +
                    '<canvas id="chartContainer-' + statistic_type.name.split(' ').join('_') + '_' + country.id + '">Loading data ...</canvas>' +
                    '</div></div>';

                var statisticTypeExplanation = statistic_type.explanation ? '<p class="explanation"><span class="glyphicon glyphicon-info-sign"></span>' + statistic_type.explanation + '</p>' : '';

                if (isCompare) {
                    $(statistic_detail_div).html(statisticTypeExplanation +
                        statistic_detail_data);
                } else {
                   $(statistic_detail_div).html(
                        '<h2>' + statistic_type.name + '</h2>' + statisticTypeExplanation +
                        statistic_detail_data);
                }

                generate_statistic_data(statistic_details, statistic_type, country.id);
            }
        }

        function generate_statistic_data(statistic_details, statistic_type, country_id) {
            var Chart = require('chart.js');

            var detail_div = document.getElementById('chartContainer-' + statistic_type.name.split(' ').join('_') + '_' + country_id);
            var ctx = detail_div.getContext("2d");

            switch (statistic_type.type) {
                case "inhabitants":
                case "€":
                case "$":
                    if (statistic_details.length == 1) {
                        showData(statistic_details, statistic_type, detail_div, statistic_type);
                    } else {
                        var data = createDataForChart(statistic_details, statistic_type);
                        createBarChart(data, ctx, statistic_type);
                    }
                    break;
                case "years":
                    createYearData(statistic_type, country_id, ctx);
                    break;
                case "top":
                    createRanking(detail_div, statistic_type, country_id);
                    break;
                case "%":
                    var data = createDataForChart(statistic_details, statistic_type);
                    createDoughnutChart(data, ctx, statistic_type);
                    break;

                default:
                    if (statistic_details.length == 1) {
                        showData(statistic_details, statistic_type, detail_div, statistic_type);
                    } else {
                        var data = createDataForChart(statistic_details, statistic_type);
                        createLineChart(data, ctx, statistic_type);
                    }
            }
        }

        function createDataForChart(statistic_details, statistic_type) {
            var generatedDataPoints = [];
            var generatedDataPointsForLabel = [];
            var generatedDataLabels = [];

            $(statistic_details).each(function (i, detail) {
                var year = detail.year;
                var value = detail.value;

                generatedDataPoints.push(value);
                generatedDataPointsForLabel.push((formatNumber(value) + " " + statistic_type.type + " " + statistic_type.name));
                generatedDataLabels.push(year.toString());
            });
            var data = {};
            data.generatedDataPoints = generatedDataPoints;
            data.generatedDataPointsForLabel = generatedDataPointsForLabel;
            data.generatedDataLabels = generatedDataLabels;

            return data;
        }

        function showData(statistic_details, statistic_type, detail_div) {
            var detail_string = "";
            var stat_type = statistic_type.type;
            $(statistic_details).each(function (i, detail) {
                var data_value = formatNumber(detail.value);
                if (data_value) {
                    detail_string += "<div class='data-div'><img src='/img/coins.png'><p class='data'>" + data_value + " " + stat_type + "</p>";
                    detail_string += "<p> in " + detail.year + "</p></div>";
                }
            });
            if (detail_string == "") {
                detail_string = '<div class="alert alert-info">Oops! There is no data available!</div>';
            }

            $(detail_div).closest("div.chart").html(detail_string);
        }

        function createYearData(statistic_type, country_id, ctx){
            $.ajax({ // ask for data and add to div
                type: 'GET',
                url: '/getStatisticTypeSubTypes',
                data: {
                    statistic_type_id: statistic_type.id,
                    country_id: country_id
                },

                success: function (subTypeDetails) {
                    var generatedDataPoints = [];
                    var generatedDataPointsForLabel = [];
                    var generatedDataLabels = [];

                    var sub_statistic_type = subTypeDetails[Object.keys(subTypeDetails)[0]]["subType"];

                    $.each(subTypeDetails, function (name, obj) {
                        if(obj["subTypesDetails"]){
                            var detail = obj["subTypesDetails"][0];
                            var year = detail.year;
                            var value = detail.value;

                            generatedDataPoints.push(value);
                            generatedDataPointsForLabel.push(year);
                            generatedDataLabels.push(name);
                        }
                    });
                    var data = {};
                    data.generatedDataPoints = generatedDataPoints;
                    data.generatedDataPointsForLabel = generatedDataPointsForLabel;
                    data.generatedDataLabels = generatedDataLabels;

                    createBarChart(data, ctx, statistic_type, sub_statistic_type);
                }
            });
        }

        function createRanking(detail_div, statistic_type, country_id) {
            $.ajax({ // ask for data and add to div
                type: 'GET',
                url: '/getStatisticTypeSubTypes',
                data: {
                    statistic_type_id: statistic_type.id,
                    country_id: country_id
                },

                success: function (subTypeDetails) {
                    var detail_string = '<div class="alert alert-info">Oops! There are no details available</div>';

                    if(subTypeDetails){
                        var year = subTypeDetails[Object.keys(subTypeDetails)[0]]["subTypesDetails"][0].year;
                        detail_string = "<ul class='list-group'><li class='list-group-item'>Rankings of " + year + "</li>";

                        $.each(subTypeDetails, function (name, obj) {
                            if(obj["subTypesDetails"]){
                                detail_string += "<li class='list-group-item'><b>" + name + "</b>: ";
                                var detail = obj["subTypesDetails"][0];
                                var subType = obj["subType"];
                                var type = subType.type == "%" ? subType.type : "";

                                detail_string += detail.value + " " + type + "</li>";
                            }
                        });

                        detail_string += "</ul>";
                    }

                    $(detail_div).closest("div.chart").html(detail_string);
                }
            });
        }


        /* ------------------------------------------------------------ */
        /*                  Different Chart Types                       */

        /**
         * Line Chart
         * @param data
         * @param ctx
         * @param statistic_type
         */
        function createLineChart(data, ctx, statistic_type) {
            var myLineChart = new Chart(ctx, {
                type: 'line',
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
                    display: true,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                return " " + formatNumber(tooltipItem.yLabel) + " " + statistic_type.type;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: statistic_type.description,
                        fontSize: 15,
                        padding: 25
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            min: 0,
                            ticks: {
                                // Include a dollar sign in the ticks
                                callback: function (value, index, values) {
                                    return " " + formatNumber(value) + " " + statistic_type.type;
                                }
                            }
                        }]
                    }
                }
            });
        }

        /**
         * Doughnut Chart
         * @param data
         * @param ctx
         * @param statistic_type
         */
        function createDoughnutChart(data, ctx, statistic_type) {
            // TODO SR this is just a quick fix - rework logic here
            if (data.generatedDataPoints.length == 1) {
                var num = formatNumber(100 - data.generatedDataPoints[0]);

                data.generatedDataPoints.push(num);
                data.generatedDataPointsForLabel.push(num + " " + statistic_type.type + " Non-" + statistic_type.name);
                data.generatedDataLabels.push(data.generatedDataLabels[0]);
            }

            var doughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.generatedDataPointsForLabel,
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
                        reverse: true,
                        onClick: (e) => e.stopPropagation(),
                        position: 'top',
                        fontSize: 15
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, detail) {
                                return " " + data.generatedDataLabels[tooltipItem.index] +
                                    ": " + " " + formatNumber(data.generatedDataPoints[tooltipItem.index]) + " " + statistic_type.type;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: statistic_type.description +", "+ data.generatedDataLabels[0],
                        fontSize: 15,
                        padding: 20
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    maintainAspectRatio: false
                }
            });
        }

        /**
         * Bar Chart
         * @param data
         * @param ctx
         * @param statistic_type
         */
        function createBarChart(data, ctx, statistic_type, sub_statistic_type = false) {
            var year = "";
            if(sub_statistic_type)
                year =  ", " + data.generatedDataPointsForLabel[0];
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
                                min: 0,
                                // Include a dollar sign in the ticks
                                callback: function (value, index, values) {
                                    if(sub_statistic_type)
                                        return " " + formatNumber(value) + " " + sub_statistic_type.type;
                                    return " " + formatNumber(value) + " " + statistic_type.type;
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                if(sub_statistic_type)
                                    return " " + formatNumber(tooltipItem.yLabel) + " " + sub_statistic_type.type;
                                return " " + formatNumber(tooltipItem.yLabel) + " " + statistic_type.type;
                            }
                        }
                    },
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: statistic_type.description + year,
                        fontSize: 15,
                        padding: 30
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }


        function formatNumber(n, onlyNumber = false) {
            if(isNaN(n)) {
                return n;
            }

            var numb;
            if (n > 1000000000000) {
                numb = divide(n, 1000000000000);
                if (!onlyNumber) numb = numb + ' trillion';
                return numb;
            } else if (n > 1000000000) {
                numb = divide(n, 1000000000);
                if (!onlyNumber) numb = numb + ' billion';
                return numb;
            } else if (n > 1000000) {
                numb = divide(n, 1000000);
                if (!onlyNumber) numb = numb + ' million';
                return numb;
            } else if (n > 1000) {
                numb = divide(n, 1000);
                if (!onlyNumber) numb = numb + ' thousand';
                return numb;
            }

            return divide(n, 1);
        }

        function divide(dividend, divisor) {
            var quotient = dividend / divisor;

            if(quotient % 1 != 0) return Number(quotient).toFixed(2);

            return quotient;
        }


        var mq = window.matchMedia( "(max-width: 767px)" );
        if (mq.matches) {
            var elem = $('.country');
            $('.menu__left').before(elem);

        } else {
            // window width is less than 500px
        }
    }

};