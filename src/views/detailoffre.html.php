<h1>
    <?php 
    echo $title . $data[0]["villeDepart"] . " => " . $data[0]["villeArrivee"];
    //var_dump($data);
    ?>
</h1>

<p>
    <a href='index.php?controller=user&action=profil'><button>Informations profil</button></a>
</p>

<section>
    <?php 
    echo "<section>";
    
    echo "<p>" . $dates[0];
    
    echo " " . $data[0]['heure'];
    echo " de " . $data[0]['adresseDepart'] . " " . $data[0]['villeDepart'];
    echo " à " . $data[0]['adresseArrivee'] . " " . $data[0]['villeArrivee'];
    
    if ($_SESSION["uid"] !== $data[0]["idUser"]) {
        echo '  <button><a href="?controller=offers&action=choisiroffre&id=' . $data[0]['id'] . '">Je choisis ce trajet !</a></button>  ';
    }
    
    echo "</p>";
    ?>
    <div>
        <h3>Conducteur :  </h3>
        <p>
            <?php
            echo $data[0]['prenom'] . " " . $data[0]['nom'];
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
    echo "<ul><h3>Passagers : </h3>";
    
    foreach ($data2 as $oneData) {
        echo "<li>" . $oneData['nom'] . " " . $oneData['prenom'] . " " . $oneData['tel'] . " " . $oneData['email'] . "</li>";
        
    }
    
    echo "</ul>";
    echo "<ul><h3>Ramassages : </h3>";
    
    for ($i = 0; $i < count($data); $i++) {
        echo "<li>" . $data[$i]['adresse'] . " " . $data[$i]['ville'];
        echo "<ul><h3>Passagers : </h3>";
        if (isset($data3[$i])) {
            echo "<li>" . $data3[$i]['nom'] . " " . $data3[$i]['prenom'] . " " . $data3[$i]['tel'] . " " . $data3[$i]['email'] . "</li>";
        } else {
            echo "<li>Aucun passager</li>";
        }
        echo "</ul>";
        echo "</li>";
    }
    
    echo "</ul>";
    
    if (isset($_SESSION["uid"]) && $_SESSION["uid"] === $data[0]["idUser"]) {
        echo '  <button><a href="?controller=offers&action=modifieroffreform&id=' . $data[0]['id'] . '">Modifier</a></button>  ';
        echo '  <button><a href="?controller=offers&action=deleteoffre&id=' . $data[0]['id'] . '">Supprimer</a></button>  ';
    }
    
    echo "</section>";
    ?>
</section>

<p>
	<a href='index.php?controller=offers&action=offres'><button>Retour à la recherche</button></a>
    <a href='index.php?controller=offers&action=mesoffres'><button>Mes Offres</button></a>
    <a href='index.php?controller=offers&action=ajouteroffre'><button>Ajouter Offre</button></a>
</p>