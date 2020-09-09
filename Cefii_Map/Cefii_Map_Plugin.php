<?php
    class Cefii_Map_Plugin {
        function cefii_map_install(){
            global $wpdb;
            $table_site = $wpdb->prefix.'cefiimap';
            if($wpdb->get_var("SHOW TABLES LIKE '$table_site'")!=$table_site){
                $sql= "CREATE TABLE `$table_site`(`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY , `titre` TEXT NOT NULL,`longitude` TEXT NOT NULL, `latitude` TEXT NOT NULL)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
                require_once(ABSPATH.'wp-admin/includes/upgrade.php');
                dbDelta($sql);
            }
        }
        function init(){
            if(function_exists('add_options_page')){
                $mapage = add_options_page('CEFII Map', 'CEFii Map', 'administrator', 
                    dirname(__FILE__), array($this, 'cefii_map_admin_page'));
                add_action('load-'.$mapage, array($this, 'cefii_map_admin_header'));
            }
        }
        function cefii_map_admin_page(){
            if(isset($_GET['p']) && $_GET['p'] == 'map'){
                require_once('template-map.php');
            }else{
                require_once('template-admin.php');
            }
            if(isset($_GET['map'])){
                if($_GET['map'] == 'ok'){
                    echo '<p class ="sucess">'.__('The card has been registered', 'cefii-map').'</p>';
                }
                if($_GET['map'] == 'deleteok'){
                    echo '<p class="sucess">'.__('The card has been deleted.', 'cefii-map').'</p>';
                }
            }


            if(isset($_GET['action'])){
                if($_GET['action'] == 'createmap'){
                    if((trim($_POST['Cm-title'])!='') && (trim($_POST['Cm-latitude'])!='') && (trim($_POST['Cm-longitude'])!='')) {
                        $insertmap = $this->insertmap($_POST['Cm-title'], $_POST['Cm-latitude'], $_POST['Cm-longitude']);
                        if ($insertmap){
                            $location = get_bloginfo('url').'/wp-admin/options-general.php?page=Cefii_Map&map=ok'
                           ?>
                           <script>
                               window.location = "<?php echo $location;?>";
                           </script>
                           <?php 
                        }else{
                            echo '<p class="erreur">'.__('An error has occurred.', 'cefii-map').'</p>';
                        }
                    }else{
                        echo '<p class="erreur">'.__('Please complete all fields !', 'cefii-map').'</p>';
                    }
                }elseif($_GET['action'] == 'updatemap'){
                    if((trim($_POST['Cm-title'])!='') && (trim($_POST['Cm-latitude'])!='') && (trim($_POST['Cm-longitude'])!='') && (trim($_POST['Cm-id'])!='')) {
                        $updatemap = $this->updatemap($_POST['Cm-id'],$_POST['Cm-title'], $_POST['Cm-latitude'], $_POST['Cm-longitude']);
                        if ($updatemap){
                            $location = get_bloginfo('url').'/wp-admin/options-general.php?page=Cefii_Map&p=map&id='.$_POST['Cm-id'];
                           ?>
                           <script>
                               window.location = "<?php echo $location;?>";
                           </script>
                           <?php 
                        }else{
                            echo '<p class="erreur">'.__('An error has occurred.', 'cefii-map').'</p>';
                        }
                    }else{
                        echo '<p class="erreur">'.__('Please complete all fields !', 'cefii-map').'</p>';
                    }
                }elseif($_GET['action'] == 'deletemap'){
                    if((trim($_POST['Cm-id'])!='')) {
                        $deletemap = $this->deletemap($_POST['Cm-id']);
                        if ($deletemap){
                            $location = get_bloginfo('url').'/wp-admin/options-general.php?page=Cefii_Map&map=deleteok'
                           ?>
                           <script>
                               window.location = "<?php echo $location;?>";
                           </script>
                           <?php 
                        }else{
                            echo '<p class="erreur">'.__('An error has occurred.', 'cefii-map').'</p>';
                        }
                    }
                }
            }
        }
        function cefii_map_admin_header(){
            wp_register_style('cefii_map_css', plugins_url('css/admin-cefii-map.css', __FILE__));
            wp_enqueue_style('cefii_map_css');
            wp_enqueue_script('cefii_map_js',
                plugins_url('js/admin-cefii-map.js', __FILE__),array('jquery'));
            wp_localize_script('cefii_map_js', 'textJs', array(
                'confirmation' => __('Do you want ti delete this map?', 'cefii-map')
            ));
            wp_enqueue_script('google_map_js','https://maps.googleapis.com/maps/api/js?key='.get_option('cleApi'));
        }

        function insertmap($title, $lat, $long){
            global $wpdb;
            $table_map = $wpdb->prefix.'cefiimap';
            $sql = $wpdb->prepare(
                "INSERT INTO ".$table_map."(titre, latitude, longitude) VALUES (%s,%s,%s)",
                $title,$lat,$long
            );
            $req = $wpdb->query($sql);
            return $req;
        }

        function getmaplist(){
            global $wpdb;
            $table_map = $wpdb->prefix.'cefiimap';
            $sql ="SELECT * FROM ".$table_map;
            $maplist = $wpdb->get_results($sql);
            return $maplist;
        }

        function updatemap($id, $title, $lat, $long){
            global $wpdb;
            $table_map = $wpdb->prefix.'cefiimap';
            $sql = $wpdb->prepare(
                "UPDATE ".$table_map." SET titre=%s, latitude=%s, longitude=%s WHERE id=%d",
                $title, $lat, $long, $id
            );
            $result = $wpdb->query($sql);
            return $result;
        }

        function getmap($id){
            global $wpdb;
            $table_map = $wpdb->prefix.'cefiimap';
            $sql= $wpdb->prepare("SELECT * FROM ". $table_map." WHERE id=%d LIMIT 1",$id);
            $map= $wpdb->get_results($sql);
            return $map;
        }
        function deletemap($id){
            global $wpdb;
            $table_map = $wpdb->prefix.'cefiimap';
            $sql = $wpdb->prepare("DELETE FROM ".$table_map." WHERE id=%d LIMIT 1",$id);
            $mapdelet= $wpdb->query($sql);
            return $mapdelet;
        }
        function champ_cleApi(){
            ?>
                <input type="text" name="cleApi" id="cleApi" value="<?php echo get_option('cleApi');?>" size="50">
            <?php
        }
        function cefiiMap_options(){
            add_settings_section("cefiiMap-section", '', null, "Cefii_Map");
            add_settings_field( "cleApi", __('Your API Key', 'cefii-map'), 
                array($this,'champ_cleApi'), "Cefii_Map", "cefiiMap-section");
            register_setting("cefiiMap-section", "cleApi");
        }
        function cefii_map_front_header(){
            wp_enqueue_script('google_map_js','https://maps.googleapis.com/maps/api/js?key='.get_option('cleApi'));
        }
        function cefii_map_shortcode($att){
            $map=$this->getmap($att['id']);
            ob_start();
            ?>
            <div id="map<?php echo $map[0]->id; ?>" style="width: 400px; height:400px;"></div>
            <script>
                let map;
                map = new google.maps.Map(document.getElementById("map<?php echo $map[0]->id; ?>"), {
                center: {
                    lat: <?php echo $map[0]->latitude;?>,
                    lng: <?php echo $map[0]->longitude;?>
                },
                zoom: 8
                });
            </script>
            <?php return ob_get_clean();
        }
        function cefii_map_load_textdomain(){
            load_plugin_textdomain('cefii-map', false,
            dirname(plugin_basename(__FILE__) ) .'/languages/');
        }
    }
















































?>