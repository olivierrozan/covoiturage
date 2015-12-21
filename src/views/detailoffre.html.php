<h1>
    <?php 
    echo $title . $data[0]["villeDepart"] . " -> " . $data[0]["villeArrivee"];
    //var_dump($data);
    ?>
</h1>

<p>
    <a href='index.php?controller=user&action=profil'><button>Informations profil</button></a>
</p>

<section>
    <?php 
    echo "<section>";
    
    echo $dates[0] ;
    
    echo " " . $data[0]['heure'];
    echo " de " . $data[0]['adresseDepart'] . " " . $data[0]['villeDepart'];
    echo " à " . $data[0]['adresseArrivee'] . " " . $data[0]['villeArrivee'];
    echo " Edité par " . $data[0]['prenom'] . " " . $data[0]['nom'];
    
    echo '  <button><a href="?controller=default&action=choisiroffre&id=' . $data[0]['id'] . '">Je choisis ce trajet !</a></button>  ';
    
    echo "<ul><h3>Passagers : </h3>";
    
    foreach ($data2 as $oneData) {
        echo "<li>" . $oneData['nom'] . " " . $oneData['prenom'] . " " . $oneData['tel'] . " " . $oneData['email'] . "</li>";
        
    }
    
    echo "</ul>";
    
    echo "<ul><h3>Ramassages : </h3>";
    
    foreach ($data as $oneData) {
        echo "<li>" . $oneData['adresse'] . " " . $oneData['ville'];
        
        echo "<ul><h3>Passagers : </h3>";
    
        foreach ($data3 as $oneData) {
            echo "<li>" . $oneData['nom'] . " " . $oneData['prenom'] . "</li>";

        }

        echo "</ul>";
        
        echo "</li>";
        
    }
    
    echo "</ul>";
    
    if (isset($_SESSION["uid"]) && $_SESSION["uid"] === $data[0]["idUser"]) {
        echo '  <button><a href="?controller=default&action=modifieroffreform&id=' . $data[0]['id'] . '">Modifier</a></button>  ';
        echo '  <button><a href="?controller=default&action=deleteoffre&id=' . $data[0]['id'] . '">Supprimer</a></button>  ';
    }
    
    echo "</section>";
    ?>
</section>

<p>
	<a href='index.php?controller=default&action=offres'><button>Retour à la recherche</button></a>
    <a href='index.php?controller=default&action=mesoffres'><button>Mes Offres</button></a>
    <a href='index.php?controller=default&action=ajouteroffre'><button>Ajouter Offre</button></a>
</p>