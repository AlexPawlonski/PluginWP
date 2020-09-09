<?php
class Cefii_Contact_Widget extends WP_Widget{
    function __construct()
    {
        $widget_options = array(
            'classname' => 'widget_cefii_Contact',
            'description' => __('Widget allow a call panell', 'cefii-contact')
            
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
            <label for="title"><?php _e('Widget title :', 'cefii-contact')?></label>
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
        <form id="form_contact" action="">
            <label for="Cefii_Contact_name" name="Cefii_Contact_name">
                <?php _e('Your name:', 'cefii-contact')?>
            </label>
            <input type="text" id="Cefii_Contact_name" name="Cefii_Contact_name" value="">
            
            <label for="Cefii_Contact_phone" name="Cefii_Contact_phone"> <?php _e('Your Phone:', 'cefii-contact')?>
            </label>
            <input type="text" id="Cefii_Contact_phone" name="Cefii_Contact_phone" value="">
            <button type="button" id="Cefii_Contact_submit"><?php _e('CALL ME', 'cefii-contact')?></button>
            <div id="result"></div>
        </form>
        <?php 
        echo $after_widget;
    }
}


?>