<script type="text/javascript">
    $(function(){        
        $("#divdate").show();
        $("#divjour").hide();
        
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
        
        $("#ajouterRamassageButton").on("click", function() {
            var ram = '<div class="ramassage">';
            ram += '<br><label">Adresse</label><br>';
            ram += '<input type="text" class="input" name="ramassage[]" value="placeRamassage"/><br>';
            ram += '</div>';
        
            $(".ramassages").append(ram);
            
        });
        
        $("#supprimerRamassageButton").on("click", function() {
            if ($(".ramassage").length > 0) {
                $(".ramassage").last().remove();
            }
        });
        
        $("#ajoutDepart, #ajoutArrivee").geocomplete()
                  .bind("geocode:result", function(event, result){
                    $.log("Result: " + result.formatted_address);
                  })
                  .bind("geocode:error", function(event, status){
                    $.log("ERROR: " + status);
                  })
                  .bind("geocode:multiple", function(event, results){
                    $.log("Multiple: " + results.length + " results found");
                  });
    });
</script>

<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?php 
                    echo $title;
                    ?>
                </h1>
            </div>
            
            <form action="?controller=offers&action=insertoffre" method="POST">

                <label for="periode">Période</label><br>
                <select id="periode" class="input" name="periode" data-role="slider" data-inline="true">
                    <option value="ponctuelle">Ponctuelle</option>
                    <option value="permanente">Permanente</option>
                </select><br><br>

                <div id="divjour">
                    <label for="jour">Jour</label><br>
                    <select id="jour" class="input" name="jour" data-role="slider" data-inline="true">
                        <option value="lundi">Lundi</option>
                        <option value="mardi">Mardi</option>
                        <option value="mercredi">Mercredi</option>
                        <option value="jeudi">Jeudi</option>
                        <option value="vendredi">Vendredi</option>
                        <option value="samedi">Samedi</option>
                        <option value="dimanche">Dimanche</option>
                    </select>
                </div><br>

                <div id="divdate">
                    <label for="date">Date</label><br>
                    <input id="date" class="input" type="date" name="date" placeholder="01/01/2016" value="<?php echo date('Y-m-d'); ?>"/>
                </div><br>

                <div class="heure">
                    <label for="heure">Heure</label><br>
                    <input id="heure" class="input" type="time" name="heure" value="<?php echo date("H:i"); ?>">
                </div><br>

                <div class="depart">
                    <label for="ajoutDepart">Depart</label><br>
                    <input id="ajoutDepart" class="input" type="text" name="depart" value=""/><br>
                </div>

                <div class="arrivee">
                    <br><label for="ajoutArrivee">Arrivee</label><br>
                    <input id="ajoutArrivee" class="input" type="text" name="arrivee" value=""/><br>
                </div><br>

                <div class="ramassages">
                    <input id="ajouterRamassageButton" class="btn btn-sm btn-primary input" type="button" value="Ajouter ramassage"/>
                    <input id="supprimerRamassageButton" class="btn btn-sm btn-primary input" type="button" value="Supprimer ramassage"/><br>
                </div><br>

                <input type="submit" class="btn btn-sm btn-primary" value="ok"/>
                <input type="button" class="btn btn-sm btn-primary" onclick="window.location='index.php?controller=offers&action=mesoffres'" value="annuler"/>
            </form>
        </div>
    </div>
</section>