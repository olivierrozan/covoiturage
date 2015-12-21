<h1>
    <?php 
    echo $title;
    ?>
</h1>

<p>
    <a href='index.php?controller=user&action=profil'><button>Informations profil</button></a>
</p>

<section>
    <form action="?controller=default&action=mesoffres" method="POST">
        <?php 
        echo "<ul>";

        for ($i = 0; $i < count($data); $i++) {
            echo '<li><a href="index.php?controller=default&action=detailsoffre&id=' . $data[$i]['id'] . '">';
            echo '<input type="checkbox" name="' . $data[$i]['id'] . '" id="' . $data[$i]['id'] . '"/>';
            echo $dates[$i] . " " . $data[$i]['heure'];
            echo " de " . $data[$i]['adresseDepart'] . " " . $data[$i]['villeDepart'];
            echo " à " . $data[$i]['adresseArrivee'] . " " . $data[$i]['villeArrivee'] . "</a>";
            echo '  <button><a href="?controller=default&action=modifieroffreform&id=' . $data[$i]['id'] . '">Modifier</a></button>  ';
            echo '  <button><a href="?controller=default&action=deleteoffre&id=' . $data[$i]['id'] . '">Supprimer</a></button>  ';
            echo '</li>';
        }

        echo "</ul>";
        ?>
        <input type="submit" value="Supprimer les éléments sélectionnés"/>
    </form>
</section>

<p>
	<a href='index.php?controller=default&action=offres'><button>Offres</button></a>
    <a href='index.php?controller=default&action=mesoffres'><button>Mes Offres</button></a>
    <a href='index.php?controller=default&action=ajouteroffre'><button>Ajouter Offre</button></a>
</p>