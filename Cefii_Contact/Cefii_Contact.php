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
__('Insert an option to be called', 'cefii-contact');
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
            register_activation_hook(__FILE__, array($inst_contact, 'cefii_contact_install'));
            add_action('wp_head', array($inst_contact, 'cefii_contact_front'));

            if(isset($_POST['action'])){
                add_action('wp_ajax_nopriv_cefii_contact', array($inst_contact, 'cefii_contact_front_ajax'));
                add_action('wp_ajax_cefii_contact', array($inst_contact, 'cefii_contact_front_ajax'));
                add_action("wp_ajax_suppr_cefii_contact", array($inst_contact, 'cefii_contact_admin_ajax'));
                }
            add_action('admin_menu', array($inst_contact, 'cefii_contact_menu'));
            
        }
    }
}

$inst_map = new Cefii_Contact();


?>