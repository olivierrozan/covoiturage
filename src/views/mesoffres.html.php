<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <h1>
                <?php 
                echo $title;
                ?>
				<a href='index.php?controller=offers&action=ajouteroffre'><button class="btn btn-sm btn-primary">Ajouter Offre</button></a>
            </h1>
            <hr>
            <?php 
            echo "<table class='table table-striped table-bordered' style='float:left; width:500px;'>";

            for ($i = 0; $i < count($data); $i++) {
                echo '<tr><td>';
                echo '<a href="?controller=offers&action=detailsoffre&id=' . $data[$i]['id'] . '"><div style="float:left;">';
                echo $dates[$i] . " à " . $data[$i]['heure']
                        . "<br><br>Départ :  " . $data[$i]['adresseDepart'] . " " . $data[$i]['codePostalDepart'] . " " . $data[$i]['villeDepart']
                        . "<br>Arrivée :  " . $data[$i]['adresseArrivee'] . " " . $data[$i]['codePostalArrivee'] . " " . $data[$i]['villeArrivee'];
                echo '</div>';
                
                if (isset($_SESSION["uid"]) && $_SESSION["uid"] !== $data[$i]["idUser"]) {
                    echo '<div style="float:left; line-height:100px; margin-left:50px;"><a href="?controller=offers&action=choisiroffre&id='
                    . $data[$i]['id'] . '"><button class="btn btn-sm btn-primary">Je choisis ce trajet !</button></div></a>';
                }
                
                echo "<div style='clear:both;'></div>";
                echo "</td></tr>";
            }

            echo "</table><div style='clear:both;'></div>";
            ?>
                
            <p>
                <a href='index.php?controller=offers&action=ajouteroffre'><button class="btn btn-sm btn-primary">Ajouter Offre</button></a>
            </p>
        </div>
    </div>
</section>

