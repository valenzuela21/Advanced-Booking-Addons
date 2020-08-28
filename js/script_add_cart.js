(function ($) {
    $(document).on('click', '.add_cart_shooping', function (e) {
        e.preventDefault();
        var product_qty = $('input[name=counter_product]').val() || 1;
        var product_id = $('input[name=id_product]').val();
        var variation_id = $('input[name=variation_id]').val() || 0;

        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $('.alert-modal-success').html(`<div class="content-alert-modal">
<div class="shaddow-alert-modal" ></div>
<div class="content-alert-description">
<div class="spinner">
  <div class="bounce1"></div>
  <div class="bounce2"></div>
  <div class="bounce3"></div>
</div>
!Attaching to the cart¡
</div>
</div>`);
            },

            complete: function (response) {
                $('.alert-modal-success').html(`<div class="content-alert-modal">
<div class="shaddow-alert-modal" ></div>
<div class="content-alert-description">
!Was inserted into the cart¡
</div>
</div>`);
                location.reload();
            },

            success: function (response) {
                if (response.error && response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    location.reload();
                }
            },
        });

    })

})
(jQuery);