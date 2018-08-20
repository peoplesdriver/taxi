$( document ).ready(function() {

    $('.selectize').selectize({
        sortField: 'text',
        create:function (input){
            var result = $.ajax({
                url: '/api/ajax/tag',
                type: 'GET',
                async: false,
                datatype: 'json',
                data: "title="+input,
                success: function (result) {
                    return result;
                }
            });

            var tag = jQuery.parseJSON(result.responseText);
            console.log(tag);
            return {
                value: tag.id,
                text: input
            }

        }
    });

    if ( $('.datetime').length ) {
        flatpickr.localize(flatpickr.l10ns.ru);
        var date = $('#expiration_date').val();
        if (date == '') {
            var now = new Date();
            var month = now.getMonth()+1;
            month = (month < 10) ? '0'+month : month +'-'+now.getDate();
            date = now.getFullYear()+'-'+month+'-'+now.getDate()+' 08:00';
        }
        console.log(date);
        $('.datetime').flatpickr({
            enableTime: true,
            time_24hr: true,
            minDate: "today",
            defaultDate: date,
            dateFormat: 'Y-m-d H:i'
        });
    }

});