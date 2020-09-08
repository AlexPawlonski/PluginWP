<div id="apiKey">
    <p><strong>Important. Une clé API est nécessaire pour afficher les carte Google</strong></p>
    <a href="https://console.developers.google.com/" target="_blanck ">Obtenir une clé API grapheme_extratuitement</a>
    <p>Après création de la clé API, collez-la ci-dessous.</p>
</div>
<form action="options.php" method="POST">
    <?php 
    settings_fields( "cefiiMap-section" );
    do_settings_sections("Cefii_Map");
    submit_button("Enregister la clé")
    ?>
</form>

<div id="menuMap">
    <ul>
        <li id="active">Créer une carte</li>
        <?php
        $maplist = $this->getmaplist();
        foreach($maplist as $map){
            echo "<li><a href='?page=Cefii_Map&p=map&id=".$map->id."'>".$map->titre."</a></li>";
        }
        ?>
    </ul>
</div>
<h3 class="title">Créer une carte :</h3>
<div class="warpCefiiMap">
    
    <form action="?page=Cefii_Map&action=createmap" id="formMap" method="post">
        <p>
            <label for="Cm-title">Titre* :</label><br>
            <input type="text" id="Cm-title" name="Cm-title">
            <p class="errorCefiiMap" id="Cm-title-error">
                Veuillez renseigner un titre.
            </p>
        </p>
        <p>
            <label for="Cm-latitude">Latitude* :</label><br>
            <input type="text" id="Cm-latitude" name="Cm-latitude">
            <p class="errorCefiiMap" id="Cm-latitude-error">
                Veuillez renseigner une latitude.
            </p>
        </p>
        <p>
            <label for="Cm-longitude">Latitude* :</label><br>
            <input type="text" id="Cm-longitude" name="Cm-longitude">
            <p class="errorCefiiMap" id="Cm-longitude-error">
                Veuillez renseigner une longitude.
            </p>
        </p>
        <i><small>* champs obligatoires</small></i>
        <p>
            <input type="button" id="b-map" value="Enregistrer" class="button-primary">
        </p>
    </form>
</div>