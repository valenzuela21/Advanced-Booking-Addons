(function ($) {

        $('#save_config').click(function(){

            let respuesta = $('#url_web').val();

            let datos = {
                action: 'save_config_booking_results',
                respuesta: respuesta
            }

        $.ajax({
                url: admin_url.ajax_url,
                type: 'post',
                data: datos
             }).done(function(respuesta) {
                 $('#alert-success').html('Data saved correctly.')
                 console.log(respuesta);
             });
        });

})(jQuery);