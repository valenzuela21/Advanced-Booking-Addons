<?php
if (!defined('ABSPATH')) exit;

class pageAdmin
{

    function __construct()
    {
        add_action('admin_menu', array($this, 'page_admin_booking_config'));
        add_action('admin_enqueue_scripts', array($this,'admin_css_js_booking'), 10, 1);
        add_action('wp_ajax_nopriv_save_config_booking_results', array($this,'save_config_booking_results'));
        add_action('wp_ajax_save_config_booking_results', array($this,'save_config_booking_results'));

    }

    public function admin_css_js_booking($hook){
           if($hook == 'toplevel_page_config_admin_booking'){
               wp_enqueue_script('admin_save_config_booking', plugins_url('./js/script_save_config.js', __FILE__), array('jquery'), 1.0, true );
               wp_localize_script( 'admin_save_config_booking', 'admin_url', array(
                   'ajax_url' => admin_url('admin-ajax.php')
               ) );
           }
    }


    public function page_admin_booking_config()
    {
        add_menu_page(
            __('Config Booking', 'textdomain'),
            __('Config Booking', 'textdomain'),
            'read',
            'config_admin_booking',
            array($this, 'my_custom_page_config'),
            'dashicons-store',
            6
        );
    }

    public function my_custom_page_config()
    {   $admin_url = get_option('config_admin_save');
        echo "<div class='wrap'>
                    <h1 class='wp-heading-inline'> ".__('Config Booking','avanced-booking-addons')." </h1>
                    <table class='form-table'>
                        <tr>
                        <th scope='row'>
                        <label>".__('Url Link Subscribe','avanced-booking-addons')."</label>
                        </th>
                        <td>
                        <input type='text' id='url_web' value='$admin_url'  />
                        </td>
                    </tr>
                    <tr>
                        <buttom class='button-primary' id='save_config' type='submit' >".__('Save Change','avanced-booking-addons')." </buttom></td>
                     </tr>
                    </table>  
                    <div id='alert-success'></div>
               </div>";
    }

    public function save_config_booking_results(){
        $respuesta = $_POST['respuesta'];

        update_option('config_admin_save', $respuesta);

        header("Content-type: application/json");
        echo json_encode($respuesta) ;
        die();
    }

}

new pageAdmin();







