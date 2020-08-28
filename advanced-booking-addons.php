<?php
/*
Plugin Name:  Bookings Addons Service Time and Date
Plugin URI:   http://creatives.com.co/
Description:  Additional metabox extension avanced booking.
Version:      1.0
Author:       David Fernando Valenzuela Pardo
Author URI:   http://creatives.com.co/
License:      GPL2
License URI:  http://creatives.com.co/
Text Domain:  avanced-booking-addons
*/
if( ! defined( 'ABSPATH' ) ) {
    exit;
}
define('__FILEPATH__', dirname(__FILE__));

class bookingAddons
{

    function __construct()
    {
        add_action('cmb2_admin_init', array($this, '_booking_addons_file_inputs'));
        add_action('init', array($this, '_require_file'));
        add_action('admin_notices', array($this, 'require_class_admin_addons'));
        register_activation_hook( __FILE__, array( $this , 'activate_plugin' ) );
    }

    public function _booking_addons_file_inputs()
    {
        $prefix = '_config_booking_';

        $metabox_eventos = new_cmb2_box(array(
            'id' => $prefix . 'booking',
            'title' => __('Options Frontend Booking', 'avanced-booking-addons'),
            'object_types' => array('product'), // Post type
        ));

        $metabox_eventos->add_field(array(
            'name' => __('Option Calendar', 'avanced-booking-addons'),
            'desc' => __('Disable calendar on this product', 'avanced-booking-addons'),
            'id' => $prefix . 'calendar',
            'type' => 'checkbox',
        ));

        $metabox_eventos->add_field(array(
            'name' => __('Option Subscription', 'avanced-booking-addons'),
            'desc' => __('Enable only suscription action form', 'avanced-booking-addons'),
            'id' => $prefix . 'suscription',
            'type' => 'checkbox',
        ));

        $metabox_eventos->add_field(array(
            'name' => __('Option Payment', 'avanced-booking-addons'),
            'desc' => __('Enable only payment botom', 'avanced-booking-addons'),
            'id' => $prefix . 'payment',
            'type' => 'checkbox',
        ));

    }

    public function _require_file()
    {
        if (file_exists(__FILEPATH__ . "/component/CMB2/init.php")) {
            require_once __FILEPATH__ . '/component/CMB2/init.php';
            require_once __FILEPATH__ . '/frontend_view_booking.php';
            require_once __FILEPATH__ . '/admin_booking_page.php';
        }
    }

    public function require_class_admin_addons()
    {
        if (!class_exists('add_cartBooking')) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            ?>
            <div class="error notice">
                <p><?php _e('You are missing the main component Avanced Booking!', 'avanced-booking-addons'); ?></p>
            </div>
            <?php
        } else {
            ?>
            <div class="updated notice">
                <p><?php _e('Good, you have the main component installed! ', 'avanced-booking-addons'); ?></p>
            </div>
            <?php
        }

    }
    public function activate_plugin(){
        if (!class_exists('add_cartBooking')) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
        }
        
    }
    
}

new bookingAddons();










