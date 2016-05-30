<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <h1>
                <?php 
                echo $title;
                ?>
            </h1>
            
            <form action="?controller=offers&action=updateoffre&id=<?php echo $_GET['id']; ?>" method="POST">
    
                <label for="periode">Période</label><br>
                <select id="periode" class="form-control input" name="periode" data-role="slider" data-inline="true">
                    <option value="ponctuelle">Ponctuelle</option>
                    <option value="permanente">Permanente</option>
                </select><br><br>

                <div id="divjour" style="float:left;">
                    <label for="jour">Jour</label><br>
                    <select id="jour" class="form-control input" name="jour" data-role="slider" data-inline="true">
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
                    <input id="date" class="form-control input" type="date" name="date" placeholder="05/12/2014" value="05/12/2014"/><br>
                </div>
                <div style="clear:both;"></div><br>

                <div class="heure" style="float:left;">
                    <label for="heure">Heure</label><span id="numHeure"></span><br>
                    <input id="heure" class="form-control input" type="number" name="heure" min="0" max="23" data-highlight="true" value="5"><br>
                </div>

                <div class="minute" style="float:left;">
                <label for="minute">Minutes</label><span id="numMinute"></span><br>
                <input id="minute" class="form-control input" type="number" name="minute" min="0" max="59" step="1" data-highlight="true" value="30"><br>
                </div>
                <div style="clear:both;"></div><br>

                <div class="depart">
                    <label for="depart">Depart</label><br>
                    <input id="depart" class="form-control input" type="text" name="depart" value="place"/><br>
                </div>

                <div class="arrivee">
                    <br><label for="arrivee">Arrivee</label><br>
                    <input id="arrivee" class="form-control input" type="text" name="arrivee" value="place"/><br>
                </div><br>

                <input type="submit" value="ok"/>
                <input type="button" class="btn btn-sm btn-primary" onclick="window.location='index.php?controller=offers&action=mesoffres'" value="annuler"/>
            </form>
            
        </div>
    </div>
</section>

<script>
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
        
        $("#heure").change(function () {
            $("#numHeure").text($(this).val());
        });
        
        $("#minute").change(function () {
            $("#numMinute").text($(this).val());
        });
    });
</script>