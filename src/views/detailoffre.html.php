<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            
            <h1>
                <?php 
                echo $title . $data[0]["villeDepart"] . " => " . $data[0]["villeArrivee"];
                if (isset($_SESSION['depart']) && isset($_SESSION['arrivee'])) {
                echo "    <a href='index.php?controller=offers&action=offres&depart=" . $_SESSION['depart'] . "&arrivee=" . $_SESSION['arrivee'] . "'>"
                    . "<button class='btn btn-sm btn-primary'>Retour Offre Recherchée</button>"
                    . "</a>"; 
                }
                ?>
                
                <a href='index.php?controller=offers&action=ajouteroffre'><button class="btn btn-sm btn-primary">Ajouter Offre</button></a>
            </h1>
            
            <?php     
            echo "<p>" . $dates[0];

            echo " " . $data[0]['heure'];
            echo " de <span id='origin'>" . $data[0]['adresseDepart'] . " " . $data[0]['codePostalDepart'] . " " . $data[0]['villeDepart'];
            echo "</span> à <span id='destination'>" . $data[0]['adresseArrivee'] . " " . $data[0]['codePostalArrivee'] . " " . $data[0]['villeArrivee'] . "</span>";

            if (isset($_SESSION["uid"]) && $_SESSION["uid"] !== $data[0]["idUser"]) {
                echo '  <button class="btn btn-sm btn-primary"><a href="?controller=offers&action=choisiroffre&id=' . $data[0]['id'] . '">Je choisis ce trajet !</a></button>  ';
            }

            echo "</p>";
            ?>
            
            <section style='float:left; width:20%;' id="d_trajet">
                <h3>Trajet</h3>
                <?php
                echo "<ul><h5>Passagers directs : </h5>";

                foreach ($data2 as $oneData) {
                    echo "<li style='font-size:16px;'>"/* . $oneData['id'] . " "  */. $oneData['nom'] . " " . $oneData['prenom'] ./* " " . $oneData['adresse'] . " " . 
                        $oneData['codePostal'] . " " . $oneData['ville'] . " " . $oneData['tel'] . " " . $oneData['email'] . */"</li>";
                }

                echo "</ul>";
                echo "<ul><h5>Ramassages : </h5>";

                for ($i = 0; $i < count($data); $i++) {
                    echo "<li style='font-size:16px;'><b>"/* . $data[$i]['id'] . " " */. $data[$i]['adresse'] . "<br>" . $data[$i]['codePostal'] . " " . $data[$i]['ville'];
                    echo "</b><ul style='margin-left:25px;'><h5>Passagers : </h5>";

                    for ($j = 0; $j < count($data3); $j++) {
                        if (isset($data3[$j]) && $data3[$j]['id'] === $data[$i]['idRamassage']) {
                            echo "<li style='font-size:16px;'>"/* . $data3[$j]['id'] . " " */. $data3[$j]['nom'] . " " . $data3[$j]['prenom'] . /*" " . $data3[$j]['adresse'] . " " . 
                                    $data3[$j]['codePostal'] . " " . $data3[$j]['ville'] . " " . $data3[$j]['tel'] . " " . $data3[$j]['email'] .*/ "</li>";
                        } 
                    }

                    echo "</ul>";
                    echo "</li>";
                }

                echo "</ul>";

                /*if (isset($_SESSION["uid"]) && $_SESSION["uid"] === $data[0]["idUser"]) {
                    echo '  <button class="btn btn-sm btn-primary"><a href="?controller=offers&action=modifieroffreform&id=' . $data[0]['id'] . '">Modifier</a></button>  ';
                    echo '  <button class="btn btn-sm btn-primary"><a href="?controller=offers&action=deleteoffre&id=' . $data[0]['id'] . '">Supprimer</a></button>  ';
                }*/

                ?>
            </section>
            
            <aside style="float:left; width:50%;" id="d_carte">
                <h3>Carte</h3>
                <button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#d_panel">Voir l'itinéraire</button>
                <div id="d_panel" class="collapse out"></div>
                <div id="d_map"></div>
            </aside>
            
            <aside style="float:left; width:20%;" id="d_conducteur">
                <h3>Conducteur</h3>
                <p>
                    <?php
                    echo "<a href='?controller=profil&action=profil'>" . $data[0]['prenom'] . " " . $data[0]['nom'] . "</a>";
                    ?>
                </p>
                <p>
                    <?php
                    echo "Email : " . $data[0]['email'] . "<br> Tel : " . $data[0]['tel'];
                    ?>
                </p>
                <p>
                    <?php
                    echo "Voiture : " . $data[0]['voiture'] . "<br> Nombre de places disponibles : " . $data[0]['nombreDePlaces'] . "/" . $data[0]['places'];
                    ?>
                </p>
            </aside>
            
            <div style='clear:both;'></div>
        </div>
    </div>
</section>
<script src="include/js/route-mapping.js"></script>
<script>
    $(function(){                
        $("input[type=submit]").hide();
        
        $("#ajouterRamassageButton").on("click", function() {
            var ram = '<div class="ramassage">';
            ram += '<br><label">Adresse</label><br>';
            ram += '<input type="text" name="ramassage[]" value="placeRamassage"/><br>';
            ram += '</div>';
        
            $(".ramassages").append(ram);
            
            $("input[type=submit]").show();
            
        });
        
        $("#supprimerRamassageButton").on("click", function() {
            if ($(".ramassage").length > 0) {
                $(".ramassage").last().remove();
            }
            
            if ($(".ramassage").length === 0) {
                $("input[type=submit]").hide();
            }
        });
    });
</script>