<h1>
    <?php 
    echo $title;
    ?>
</h1>

<form action="?controller=default&action=insertoffre" method="POST">
    
    <label for="typeoffre">Type d'offre</label><br>
    <select id="typeoffre" name="typeoffre" data-role="slider" data-inline="true">
        <option value="offresdepartentreprise">Départ Entreprise</option>
        <option value="offresarriveeentreprise">Arrivée Entreprise</option>
    </select><br><br>
    
    <label for="periode">Période</label><br>
    <select id="periode" name="periode" data-role="slider" data-inline="true">
        <option value="ponctuelle">Ponctuelle</option>
        <option value="permanente">Permanente</option>
    </select><br><br>
    
    <div id="divjour" style="float:left;">
        <label for="jour">Jour</label><br>
        <select id="jour" name="jour" data-role="slider" data-inline="true">
            <option value="lundi">Lundi</option>
            <option value="mardi">Mardi</option>
            <option value="mercredi">Mercredi</option>
            <option value="jeudi">Jeudi</option>
            <option value="vendredi">Vendredi</option>
            <option value="samedi">Samedi</option>
            <option value="dimanche">Dimanche</option>
        </select><br>
    </div>
    
    <div id="divdate" style="float:left;">
        <label for="date">Date</label><br>
        <input id="date" type="date" name="date" placeholder="05/12/2014" value="05/12/2014"/><br>
    </div>
    <div style="clear:both;"></div><br>
    
    <div class="heure">
        <label for="heure">Heure</label><span id="numHeure"></span><br>
        <input id="heure" type="number" name="heure" min="0" max="23" data-highlight="true" value="5"><br>
    </div><br>
    
    <div class="minute">
    <label for="minute">Minutes</label><span id="numMinute"></span><br>
    <input id="minute" type="number" name="minute" min="0" max="59" step="1" data-highlight="true" value="30"><br>
    </div>

    <div class="retour" style="float:left;">
        <br><label for="retour">Retour</label><br>
        <input id="retour" type="text" name="retour" value="place"/><br><br>
    </div><br>
    
    <div class="depart" style="float:left;">
        <label for="depart">Depart</label><br>
        <input id="depart" type="text" name="depart" value="place"/><br><br>
    </div><br>
    <div style="clear:both;"></div>
    
    <input type="submit" value="ok"/>
    <a href='index.php?controller=default&action=mesoffres'><button>Annuler</button></a>
</form>

<script>
    $(function(){        
        $(".depart").hide();
        $("#divdate").show();
        $("#divjour").hide();
        
        $("#typeoffre").change(function () {
            var typeoffre = $("#typeoffre").val();

            if (typeoffre === "offresdepartentreprise") {
                $(".retour").show();
                $(".depart").hide();
            } else {
                $(".depart").show();
                $(".retour").hide();
            }
        });
        
        $("#periode").change(function () {
            var typeoffre = $("#periode").val();

            if (typeoffre === "permanente") {
                $("#divdate").hide();
                $("#divjour").show();
            } else {
                $("#divdate").show();
                $("#divjour").hide();
            }
        });
        
        $("#heure").change(function () {
            $("#numHeure").text($(this).val());
        });
        
        $("#minute").change(function () {
            $("#numMinute").text($(this).val());
        });
    });
</script>