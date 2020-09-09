<?php
class Cefii_Contact_Plugin {
    function cefii_contact_install(){
        global $wpdb;
        $table_site = $wpdb->prefix.'cefiicontact';
        if($wpdb->get_var("SHOW TABLES LIKE '$table_site'")!=$table_site){
            $sql= "CREATE TABLE `$table_site`(`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY , `name` TEXT NOT NULL,`phone` TEXT NOT NULL)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
    function cefii_contact_front(){
        wp_enqueue_script('front-cefii-contact-js', 
            plugins_url('js/front-cefii-contact.js', __FILE__),array('jquery'));
        wp_localize_script('front-cefii-contact-js', 'cefiicontact', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'action' => 'cefii_contact',
            'nonce' => wp_create_nonce('cefii_contact_nonce')
        ));
    } 
    
    function cefii_contact_front_ajax(){
        check_ajax_referer('cefii_contact_nonce', 'nonce');
        $insertion = $this->insert_contact($_POST['name'], $_POST['phone']);
        if($insertion){
            $message = '<span style="color:green;">Votre demande a bien été envoyée.</span>';
        }else{
            $message = '<span style="color:red;">Une erreur est survenue, veuillez réessayer.</span>';
        }
        echo json_encode($message);
        exit;
    }


    function get_contact_list(){
        global $wpdb;
        $table_contact = $wpdb->prefix.'cefiicontact';
        $sql ="SELECT * FROM ".$table_contact;
        $contactlist = $wpdb->get_results($sql);
        return $contactlist;
    } 

    function insert_contact($name, $phone){
        global $wpdb;
        $table_contact = $wpdb->prefix.'cefiicontact';
        $sql = $wpdb->prepare(
            "INSERT INTO ".$table_contact." (name, phone) VALUES (%s,%s)",
            $name,$phone
        );
        $req = $wpdb->query($sql);
        return $req;
    }

    function delete_contact($id){
        global $wpdb;
        $table_contact = $wpdb->prefix.'cefiicontact';
        $sql = $wpdb->prepare("DELETE FROM ".$table_contact." WHERE id=%d LIMIT 1",$id);
        $contactdelet= $wpdb->query($sql);
        return $contactdelet;
    }
    
}
