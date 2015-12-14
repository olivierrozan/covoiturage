<h1>
    <?php 
    echo $title;
    ?>
</h1>

<p>
    <a href='index.php?controller=user&action=logout'><button>Logout</button></a>
    <a href='index.php?controller=user&action=profil'><button>Informations profil</button></a>
</p>

<section>
    <form action="?controller=default&action=mesoffres" method="POST">
        <?php 
        echo "<ul>Departs : ";

        for ($i = 0; $i < count($data); $i++) {
            echo '<li>';
            echo '<input type="checkbox" name="' . $data[$i]['id'] . '" id="' . $data[$i]['id'] . '"/>';
            echo $data[$i]['jour'] . " " . $dates[$i] . " " . $data[$i]['heure'] . " " . $data[$i]['retour'];
            echo '  <button><a href="?controller=default&action=modifieroffredepartform&id=' . $data[$i]['id'] . '">Modifier</a></button>  ';
            echo '  <button><a href="?controller=default&action=deleteoffredepart&id=' . $data[$i]['id'] . '">Supprimer</a></button>  ';
            echo '</li>';
        }

        echo "</ul>";
        echo "<ul>Arrivées : ";

        for ($i = 0; $i < count($data2); $i++) {
            echo '<li>';
            echo '<input type="checkbox" name="' . $data2[$i]['id'] . '" id="' . $data2[$i]['id'] . '"/>';
            echo $data2[$i]['jour'] . " " . $dates2[$i] . " " . $data2[$i]['heure'] . " " . $data2[$i]['depart'];
            echo '  <button><a href="?controller=default&action=modifieroffredepartform&id=' . $data2[$i]['id'] . '">Modifier</a></button>  ';
            echo '  <button><a href="?controller=default&action=deleteoffredepart&id=' . $data2[$i]['id'] . '">Supprimer</a></button>  ';
            echo '</li>';
        }

        echo "</ul>";
        ?>
        <input type="submit" value="Supprimer les éléments sélectionnés"/>
    </form>
</section>

<p>
	<a href='index.php?controller=default&action=arrivee'><button>Offres Arrivees Entreprise</button></a>
    <a href='index.php?controller=default&action=depart'><button>Offres Depart Entreprise</button></a>
    <a href='index.php?controller=default&action=mesoffres'><button>Mes Offres</button></a>
    <a href='index.php?controller=default&action=ajouteroffre'><button>Ajouter Offre</button></a>
</p>