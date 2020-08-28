<?php
if( ! defined( 'ABSPATH' ) ) {
    exit;
}
class frondPage
{

    function __construct()
    {
        add_action('woocommerce_single_product_summary', array($this, '_frond_view_product'), 20);
        add_action('wp_enqueue_scripts', array($this, 'js_css_addons_booking'), 10, 1);

    }
    public function  js_css_addons_booking(){
        wp_enqueue_script('script_admin_booking_add_cart', plugins_url('./js/script_add_cart.js', __FILE__), array('jquery'), 1.0, true );
        wp_enqueue_style('style_frond_addons_booking', plugins_url('./css/style_frond.css', __FILE__));
    }

    public function _frond_view_product()
    {
        //get_post_meta(get_the_ID(),'_config_booking_calendar');
        $id_product = get_the_ID();
        $config_suscription = get_post_meta($id_product, '_config_booking_suscription');
        $config_payment = get_post_meta($id_product, '_config_booking_payment');

        if ($config_suscription[0] == "on") {
            $admin_url = get_option('config_admin_save');
            echo "<button class=\"btn-suscribe-click\" onclick=\"location.href='$admin_url';\">" . __('Check in', 'avanced-booking-addons') . "</button>";
        }

        if ($config_payment[0] == "on") {
            echo '<div>
                    <input style="display:none" type="text" name="id_product" value="'.$id_product.'" />
                    <div class="form-suscription" id="handleCounter_2">
	                    <button class="counter-minus btn-counter-2">-</button>
	                    <input class="booking-counter" type="text" name="counter_product" value="1">
	                    <button class="counter-plus btn-counter-2">+</button>
	                </div>
	              </div>
	        <button class="add_cart_shooping">'.__('Add Cart', 'avanced-booking-addons').'</button>';
        }

    }


}

new frondPage();