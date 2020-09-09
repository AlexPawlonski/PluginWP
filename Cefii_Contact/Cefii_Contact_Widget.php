<?php
class Cefii_Contact_Widget extends WP_Widget{
    function __construct()
    {
        $widget_options = array(
            'classname' => 'widget_cefii_Contact',
            'description' => __('Widget allow a call panell', 'cefii-map')
            
        );
        parent::__construct('widget-cefii_Contact', 'CEFII Contact', $widget_options);
    }
    function form($instance) 
    {
        $defaults = array(
            'title' => __('We contact you !', 'cefii-contact'),
            
        );
        $instance = wp_parse_args($instance, $defaults);
        ?>
        <p>
            <label for="title"><?php _e('Widget title :', 'cefii-map')?></label>
            <input 
            type="text"
            class="widefat"
            id="<?php echo $this->get_field_id('title');?>"
            name="<?php echo $this->get_field_name('title');?>"
            value="<?php echo $instance['title'];?>">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) 
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        echo $before_title .$instance['title']. $after_title;?>
        <label 
        for="<?php echo $this->get_field_id('name');?>"
        name="<?php echo $this->get_field_name('name');?>">
        <?php _e('Your name:', 'cefii-contact')?>
        </label>
        <input 
        type="text"
        for="<?php echo $this->get_field_id('name');?>"
        name="<?php echo $this->get_field_name('name');?>"
        value="">
        
        <label 
        for="<?php echo $this->get_field_id('phone');?>"
        name="<?php echo $this->get_field_name('phone');?>">
        <?php _e('Your Phone:', 'cefii-contact')?>
        </label>
        <input 
        type="text"
        for="<?php echo $this->get_field_id('phone');?>"
        name="<?php echo $this->get_field_name('phone');?>"
        value="">
        <button type="button" id="<?php echo $this->get_field_id('submit');?>"><?php _e('CALL ME', 'cefii-contact')?></button>
        <div id="<?php echo $this->get_field_name('info');?>"></div>
        <?php 
        echo $after_widget;
    }
}


?>