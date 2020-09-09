<?php

class Cefii_Map_Widget extends WP_Widget{
    function __construct()
    {
        $widget_options = array(
            'classname' => 'widget_cefii_Map',
            'description' => __('Widget allow the display of a map', 'cefii-map')
            
        );
        parent::__construct('widget-cefii_Map', 'CEFII Map', $widget_options);
    }
    function form($instance) 
    {
        $defaults = array(
            'title' => __('New Map', 'cefii-map'),
            'viewtitle' => 'yes',
            'zoom' => '17'
            
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
        <p>
            <label for="<?php echo $this->get_field_id('mapselect');?>"><?php _e('Select a Map :', 'cefii-map')?></label>
            <select 
            name="<?php echo $this->get_field_name('mapselect');?>" 
            id="<?php echo $this->get_field_id('mapselect');?>">
                <option value="0"> </option>
                <?php
                    $list = Cefii_Map_Plugin::getmaplist();
                    foreach($list as $value){
                        if($instance['map'] == $value->id){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                        ?><option selected="<?php $selected?>" value='<?php echo $value->id?>'><?php echo $value->titre?></option><?php
                    }
                ?>
            </select>
        </p>
        <p><?php _e('Or create a new Map','cefii-map')?> <a href="<?php echo admin_url()."/options-general.php?page=Cefii_Map"?>"><?php _e('Here','cefii-map')?></a>.</p>
        <p>
            <label for="title"><?php _e('Map Zoom 8 -> 17 :', 'cefii-map')?></label>
            <input 
            type="range"
            min="8"
            max="17"
            step="1"
            class="widefat"
            id="<?php echo $this->get_field_id('zoom');?>"
            name="<?php echo $this->get_field_name('zoom');?>"
            value="<?php echo $instance['zoom'];?>">
        </p>
        <p>
            <?php
            if(isset($instance['viewtitle']) && $instance['viewtitle'] == 'yes'){
                $check = "checked";
            }else{
                $check = "";
            }
            ?>
           <label for="viewtitle"><?php _e('Would you like to display the title of the map ?', 'cefii-map')?></label>
           <input 
           type="checkbox" <?php echo $check?>
           name="<?php echo $this->get_field_name('viewtitle');?>" 
           id="<?php echo $this->get_field_id('viewtitle');?>" 
           value="yes"> 
        </p>
        <?php
    }
    function update($new_instance, $old_instance) 
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['mapselect'] = strip_tags($new_instance['mapselect']);
        $instance['viewtitle'] = strip_tags($new_instance['viewtitle']);
        $instance['zoom'] = strip_tags($new_instance['zoom']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        if($instance['viewtitle'] == 'yes'){
            echo $before_title .$instance['title']. $after_title;
        }
        if($instance['mapselect'] != '0'){
            $map = Cefii_Map_Plugin::getmap($instance['mapselect']);?>
            <div id="<?php echo $this->id; ?>" style="width: 400px; height:400px;"></div>
            
            <script>
                let map;
                map = new google.maps.Map(document.getElementById("<?php echo $this->id; ?>"), {
                center: {
                    lat: <?php echo $map[0]->latitude;?>,
                    lng: <?php echo $map[0]->longitude;?>
                },
                zoom: <?php echo $instance['zoom'];?>
                });
            </script>

            <?php
        }
        echo $after_widget;
    }
}


?>