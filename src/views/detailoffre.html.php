<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            
            <h1>
                <?php 
                //var_dump($data[0]);
                echo $title . $data[0]["villeDepart"] . " => " . $data[0]["villeArrivee"];
                if (isset($_SESSION['depart'])) {
                echo "<a href='index.php?controller=offers&action=offres&depart=" . $_SESSION['depart'] . "&arrivee=" . $_SESSION['arrivee'] . "'>"
                    . "<button class='btn btn-sm btn-primary'>Retour Offre Recherchée</button>"
                    . "</a>"; 
                }
                ?>

                <a href='index.php?controller=offers&action=ajouteroffre'><button class="btn btn-sm btn-primary">Ajouter Offre</button></a>
            </h1>
            
            <?php     
            echo "<p>" . $dates[0];

            echo " " . $data[0]['heure'];
            echo " de " . $data[0]['adresseDepart'] . " " . $data[0]['villeDepart'];
            echo " à " . $data[0]['adresseArrivee'] . " " . $data[0]['villeArrivee'];

            if ($_SESSION["uid"] !== $data[0]["idUser"]) {
                echo '  <button class="btn btn-sm btn-primary"><a href="?controller=offers&action=choisiroffre&id=' . $data[0]['id'] . '">Je choisis ce trajet !</a></button>  ';
            }

            echo "</p>";
            ?>
    
            <div>
                <h3>Conducteur :  </h3>
                <p>
                    <?php
                    echo "<a href='?controller=user&action=profil'>" . $data[0]['prenom'] . " " . $data[0]['nom'] . "</a>";
                    ?>
                </p>
                <p>
                    <?php
                    echo "Email : " . $data[0]['email'] . "<br> Tel : " . $data[0]['tel'];
                    ?>
                </p>
                <p>
                    <?php
                    echo "Voiture : " . $data[0]['voiture'] . "<br> Nombre de places : " . $data[0]['places'];
                    ?>
                </p>
            </div>
            
            <?php
            echo "<ul><h3>Passagers directs : </h3>";

            foreach ($data2 as $oneData) {
                echo "<li>" . $oneData['nom'] . " " . $oneData['prenom'] . " " . $oneData['adresse'] . " " . 
                        $oneData['ville'] . " " . $oneData['tel'] . " " . $oneData['email'] . "</li>";
            }

            echo "</ul>";
            echo "<ul><h3>Ramassages : </h3>";

            for ($i = 0; $i < count($data); $i++) {
                echo "<li>" . $data[$i]['adresse'] . " " . $data[$i]['ville'];
                echo "<ul style='margin-left:50px;'><h3>Passagers : </h3>";

                for ($j = 0; $j < count($data3); $j++) {
                    if (isset($data3[$j]) && $data3[$j]['id'] === $data[$i][24]) {
                        echo "<li>" . $data3[$j]['nom'] . " " . $data3[$j]['prenom'] . " " . $data3[$j]['adresse'] . " " . 
                                $data3[$j]['codePostal'] . " " . $data3[$j]['ville'] . " " . $data3[$j]['tel'] . " " . $data3[$j]['email'] . "</li>";
                    } 
                }

                echo "</ul>";
                echo "</li>";
            }

            echo "</ul>";

            if (isset($_SESSION["uid"]) && $_SESSION["uid"] === $data[0]["idUser"]) {
                echo '  <button class="btn btn-sm btn-primary"><a href="?controller=offers&action=modifieroffreform&id=' . $data[0]['id'] . '">Modifier</a></button>  ';
                echo '  <button class="btn btn-sm btn-primary"><a href="?controller=offers&action=deleteoffre&id=' . $data[0]['id'] . '">Supprimer</a></button>  ';
            }

            ?>
            
        </div>
    </div>
</section>

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