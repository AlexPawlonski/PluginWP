<?php
/*
Plugin Name: CEFII Contact Phone
Plugin URI: https://www.cefii.fr
Description: Insert an option to be called
Author: Moi 
Version: 0.1
Licence: GPL2
Text Domain: cefii-contact
Domain Path: /languages/
*/
__('Insert an option to be called', 'cefii-map');
class Cefii_Contact{
    function __construct(){
        include_once plugin_dir_path(__FILE__).'/Cefii_Contact_Plugin.php';
        include_once plugin_dir_path(__FILE__).'/Cefii_Contact_Widget.php';
        if(class_exists('Cefii_Contact')){
            $inst_contact = new Cefii_Contact_Plugin();
        }

        if(isset($inst_contact)){
            add_action('widgets_init', function(){
                register_widget('Cefii_Contact_Widget');
            });
        }
    }
}

$inst_map = new Cefii_Contact();


?>