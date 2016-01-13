<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <h1>
                <?php 
                echo $title . " " . $data2[0] . " - " . $data3[0];
                ?>
            </h1>
            <hr>
            <?php 
            echo '<ul>';

            for ($i = 0; $i < count($data); $i++) {
                echo '<li>';
                echo '<div style="float:left;"><a href="?controller=offers&action=detailsoffre&id=' . $data[$i]['id'] . '">';
                echo $dates[$i] . " " . $data[$i]['heure']
                        . "<br><br>Départ :  " . $data[$i]['adresseDepart'] . " " . $data[$i]['codePostalDepart'] . " " . $data[$i]['villeDepart']
                        . "<br>Arrivée :  " . $data[$i]['adresseArrivee'] . " " . $data[$i]['codePostalArrivee'] . " " . $data[$i]['villeArrivee'];
                echo '</div>';
                echo '<div style="float:left; line-height:100px; margin-left:50px;"><a href="?controller=offers&action=choisiroffre&id=' . $data[$i]['id'] . '"><button class="btn btn-sm btn-primary">Je choisis ce trajet !</button></a></div>';
                echo "<div style='clear:both;'></div>";
                echo "</li><hr>";
            }

            echo '</ul>';
            ?>

        </div>
    </div>
</section>