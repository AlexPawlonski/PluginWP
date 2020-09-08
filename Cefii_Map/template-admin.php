<div id="menuMap">
    <ul>
        <li id="active"><?php _e('Create a map', 'cefii-map');?></li>
        <?php
        $maplist = $this->getmaplist();
        foreach($maplist as $map){
            echo "<li><a href='?page=Cefii_Map&p=map&id=".$map->id."'>".$map->titre."</a></li>";
        }
        ?>
    </ul>
</div>
<div id="apiKey">
    <p><strong><?php _e('Important. An API key is required to display Google maps', 'cefii-map');?></strong></p>
    <a href="https://console.developers.google.com/" target="_blanck "><?php _e('Get an API key for free', 'cefii-map');?></a>
    <p><?php _e('After creating the API key, paste it below.', 'cefii-map');?></p>
</div>
<form action="options.php" method="POST">
    <?php 
    settings_fields( "cefiiMap-section" );
    do_settings_sections("Cefii_Map");
    submit_button(__('Register the key', 'cefii-map'));
    ?>
</form>
<h3 class="title"><?php _e('Create a map', 'cefii-map');?></h3>
<div class="warpCefiiMap">
    
    <form action="?page=Cefii_Map&action=createmap" id="formMap" method="post">
        <p>
            <label for="Cm-title"><?php _e('Title*:', 'cefii-map');?></label><br>
            <input type="text" id="Cm-title" name="Cm-title">
            <p class="errorCefiiMap" id="Cm-title-error">
                <?php _e('Please enter a title.', 'cefii-map');?>
            </p>
        </p>
        <p>
            <label for="Cm-latitude">Latitude* :</label><br>
            <input type="text" id="Cm-latitude" name="Cm-latitude">
            <p class="errorCefiiMap" id="Cm-latitude-error">
                <?php _e('Please enter a latitude.', 'cefii-map');?>
            </p>
        </p>
        <p>
            <label for="Cm-longitude">Longitude* :</label><br>
            <input type="text" id="Cm-longitude" name="Cm-longitude">
            <p class="errorCefiiMap" id="Cm-longitude-error">
                <?php _e('Please enter a longitude.', 'cefii-map');?>
            </p>
        </p>
        <i><small>* <?php _e('Required fields.', 'cefii-map');?></small></i>
        <p>
            <input type="button" id="b-map" value="Register" class="button-primary">
        </p>
    </form>
</div>