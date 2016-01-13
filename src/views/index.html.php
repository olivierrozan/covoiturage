<script type="text/javascript">
    $(function(){        
        $("#rechercheDepart, #rechercheArrivee").geocomplete()
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
            
            <form action="?controller=offers&action=offres" method="POST">
                <div class="depart">
                    <label for="rechercheDepart">Départ</label><br>
                    <input id="rechercheDepart" class="form-control input" type="text" name="villeDepart" placeholder="Départ"/>
                </div>

                <div class="arrivee">
                    <br><label for="rechercheArrivee">Arrivée</label><br>
                    <input id="rechercheArrivee" class="form-control input" type="text" name="villeArrivee" placeholder="Arrivée"/>
                </div><br>

                <div>
                    <input type="submit" class="btn btn-sm btn-primary" value="Rechercher"/>
                </div>
            </form>    
        </div>
    </div>
</section>
