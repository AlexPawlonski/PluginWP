<div id="menuMap">
    <ul>
        <li><a href="?page=Cefii_Map">Créer une carte</a></li>
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
    <label>Copiez (ctrl+c) le code et coller (ctrl+v) dans la page ou l'atricle où vous voulez que la map apparaîsse votre carte :  </label>
    <input type="text" id="shortCode" value="[cefiimap id='<?php echo $map[0]->id?>']"> <p id="copier">Copié !</p>
</div>
    <div class="warpCefiiMap">
        <div id="infosMap">
            <h3 class="title">Carte : <?php echo $map[0]->titre?></h3>
            <form action="?page=Cefii_Map&action=updatemap" id="formMap" method="POST">
                <input type="hidden" id="Cm-id" name="Cm-id" value="<?php echo $map[0]->id?>">
                <p>
                    <label for="Cm-title">Titre* :</label><br>
                    <input type="text" id="Cm-title" name="Cm-title" value="<?php echo $map[0]->titre?>">
                    <p class="errorCefiiMap" id="Cm-title-error">
                        Veuillez renseigner un titre.
                    </p>
                </p>
                <p>
                    <label for="Cm-latitude">Latitude* :</label><br>
                    <input type="text" id="Cm-latitude" name="Cm-latitude" value="<?php echo $map[0]->latitude?>">
                    <p class="errorCefiiMap" id="Cm-latitude-error">
                        Veuillez renseigner une latitude.
                    </p>
                </p>
                <p>
                    <label for="Cm-longitude">Longitude* :</label><br>
                    <input type="text" id="Cm-longitude" name="Cm-longitude" value="<?php echo $map[0]->longitude?>">
                    <p class="errorCefiiMap" id="Cm-longitude-error">
                        Veuillez renseigner une longitude.
                    </p>
                </p>
                <i><small>* champs obligatoires</small></i>
                <p>
                    <input type="button" id="b-map" value="Modifier" class="button-primary">
                </p>   
            </form>
            <form action="?page=Cefii_Map&action=deletemap" id="formMapDelete" method="POST">
                <p>
                <input type="hidden" id="Cm-id" name="Cm-id" value="<?php echo $map[0]->id?>">
                <input type="button" id="supr-map" value="Supprimer la Map" class="button-secondary">
                </p>
            </form>
        </div>
        <div id="mapPreview">
            <h3>Prévisualisation :</h3>
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
