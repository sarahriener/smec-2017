
module.exports = {
    init: function () {
        if($('#div2').not('div.filter__items--wrapper')){
            $('#data-div2').hide();
        }

        $('.compare__detail__select--item').on('drop', function(e){
           var country_elem = e.target;

            var country_id = $(country_elem).find('.filter__items--wrapper')[0].id;

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
            var statistic_detail_div = $('div.statistic_data[data-country="' + country.id + '"]');
            statistic_detail_div.empty();
        }

        function showDetails(data){
            var country = data['country'];
            var statistic_type = data['statistic_type'];
            var statistic_details = data['statistic_details'];

            var statistic_detail_div = $('div.statistic_data.detail_data[data-country="' + country.id + '"]');

            var isCompare = window.location.href.includes('compare');
            if(isCompare){

                statistic_detail_div = $('div' +
                    '.statistic_data' +
                    '.compare_data' +
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
                var statistic_detail_data = generate_statistic_data(statistic_details);

                if(isCompare){
                    $(statistic_detail_div).html(statistic_detail_data);
                } else{
                    $(statistic_detail_div).html(
                        '<h2>' + statistic_type.name + '</h2>' +
                        statistic_detail_data);
                }
            }
        }

        function generate_statistic_data(statistic_details){
            var statistic_detail_data = '';

            $(statistic_details).each(function(i, detail){
                var year =  detail.year;
                var value =  detail.value;

                statistic_detail_data += '<div><b>' + year + ':</b> ' + value + '</div>';

            });
            return statistic_detail_data;
        }

    }
};