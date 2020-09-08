<div id="menuMap">
    <ul>
        <li><a href="?page=Cefii_Map"><?php _e('Create a map', 'cefii-map');?></a></li>
        <?php
        $maplist = $this->getmaplist();
        $idpage = $_GET['id'];
        foreach($maplist as $map){
            if($map->id == $idpage){ 
                $class = "id='active";
            }else{
                $class = "";
            }
            echo "<li ".$class."><a href='?page=Cefii_Map&p=map&id=".$map->id."'>".$map->titre."</a></li>";
        }
        ?>
    </ul>
</div>
    
<?php
    $map = $this->getmap($idpage);
?>
<div id="placecode">
    <label> <?php _e('Copy (ctrl + c) the code and paste (ctrl + v) in the page or atricle where you want the map to appear your map:', 'cefii-map');?> </label>
    <input type="text" id="shortCode" value="[cefiimap id='<?php echo $map[0]->id?>']"> <p id="copier"><?php _e('Copied !', 'cefii-map');?></p>
</div>
    <div class="warpCefiiMap">
        <div id="infosMap">
            <h3 class="title"><?php _e('Map :', 'cefii-map');?> <?php echo $map[0]->titre?></h3>
            <form action="?page=Cefii_Map&action=updatemap" id="formMap" method="POST">
                <input type="hidden" id="Cm-id" name="Cm-id" value="<?php echo $map[0]->id?>">
                <p>
                    <label for="Cm-title">Titre* :</label><br>
                    <input type="text" id="Cm-title" name="Cm-title" value="<?php echo $map[0]->titre?>">
                    <p class="errorCefiiMap" id="Cm-title-error">
                        <?php _e('Please enter a title.', 'cefii-map');?>
                    </p>
                </p>
                <p>
                    <label for="Cm-latitude">Latitude* :</label><br>
                    <input type="text" id="Cm-latitude" name="Cm-latitude" value="<?php echo $map[0]->latitude?>">
                    <p class="errorCefiiMap" id="Cm-latitude-error">
                        <?php _e('Please enter a latitude.', 'cefii-map');?>
                    </p>
                </p>
                <p>
                    <label for="Cm-longitude">Longitude* :</label><br>
                    <input type="text" id="Cm-longitude" name="Cm-longitude" value="<?php echo $map[0]->longitude?>">
                    <p class="errorCefiiMap" id="Cm-longitude-error">
                        <?php _e('Please enter a longitude.', 'cefii-map');?>
                    </p>
                </p>
                <i><small>* <?php _e('Required fields.', 'cefii-map');?></small></i>
                <p>
                    <input type="button" id="b-map" value="<?php _e('Update', 'cefii-map');?>" class="button-primary">
                </p>   
            </form>
            <form action="?page=Cefii_Map&action=deletemap" id="formMapDelete" method="POST">
                <p>
                <input type="hidden" id="Cm-id" name="Cm-id" value="<?php echo $map[0]->id?>">
                <input type="button" id="supr-map" value="<?php _e('Delete Map', 'cefii-map');?>" class="button-secondary">
                </p>
            </form>
        </div>
        <div id="mapPreview">
            <h3><?php _e('Preview:', 'cefii-map');?></h3>
            <div id="map"></div>
            <script>
                let map;
                    var latitude =<?php echo $map[0]->latitude;?>;
                    var longitude =<?php echo $map[0]->longitude;?>;
                    map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: parseInt(latitude),
                        lng: parseInt(longitude)
                    },
                    zoom: 8
                    });
                
            </script>
            
        </div>
    </div> 
