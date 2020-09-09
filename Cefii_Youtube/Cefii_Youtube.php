<?php
/*
Plugin Name: CEFII Youtube
Plugin URI: https://www.cefii.fr
Description: Plugin d'ajout de youtube!
Author: Moi 
Version: 0.1
Licence: GPL2
*/

class CefiiYoutube extends WP_Widget{
    function __construct() {
        $widget_options = array(
            'classname' => 'widget_cefiiyoutube',
            'description' => 'Widget permettent l\'affichage d\'une vidéo Youtube'
        );
        parent::__construct('widget-cefiiyoutube', 'CEFII Youtube', $widget_options);
    }

    function form($instance) {
        $defaults = array(
            'title' => 'Vidéo Plugin Cefii Youtube',
            'idVideo' => ''
        );
        $instance = wp_parse_args($instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>">Titre :</label>
            <input 
                type="text" 
                class="widefat"
                id="<?php echo $this->get_field_id('title');?>"
                name="<?php echo $this->get_field_name('title');?>"
                value="<?php echo $instance['title'];?>"
                >
        </p>
        <p>
            <label for="">Identifiant de la vidéo Youtube :</label>
            <input 
            type="text" 
            class="widefat"
            id="<?php echo $this->get_field_id('idVideo');?>"
            name="<?php echo $this->get_field_name('idVideo');?>"
            value="<?php echo $instance['idVideo'];?>">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']= strip_tags($new_instance['title']);
        $instance['idVideo']= strip_tags($new_instance['idVideo']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        echo $before_title .$instance['title']. $after_title;
        if($instance['idVideo'] !== ''):
        ?>
            <iframe 
                width="560" height="315" src="https://www.youtube.com/embed/<?php echo $instance['idVideo'];?>" 
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        <?php
        endif;
        echo $after_widget;
    }

}

function register_cefii_youtube(){
    register_widget('CefiiYoutube');
}
add_action('widgets_init', 'register_cefii_youtube');