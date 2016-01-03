<h1>
    <?php 
    echo $title;
    ?>
</h1>

<p>
    <?php 
    echo '<ul>';
    
    foreach ($data as $oneData) {
        echo '<li><a href="?controller=offers&action=detailsoffre&id=' . $oneData['id'] . '">';
        echo $oneData['jour'] . " " . $oneData['date'] . " " . $oneData['heure'] . " " . $oneData['villeDepart'] . " " . $oneData['villeArrivee'];
        echo '</a>  <button><a href="?controller=offers&action=choisiroffre&id=' . $oneData['id'] . '">Je choisis ce trajet !</a></button>';
        echo '</li>';
    }
    
    echo '</ul>';
    ?>
</p>

<p>
	<a href='index.php?controller=offers&action=index'><button>Recherche</button></a>
    <a href='index.php?controller=offers&action=offres'><button>Offres</button></a>
    <a href='index.php?controller=offers&action=mesoffres'><button>Mes Offres</button></a>
</p>