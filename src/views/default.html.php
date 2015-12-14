<h1>
    <?php 
    echo $title;
    ?>
</h1>

<h4>
    <?php
    if (isset($_SESSION["login"])) {
        echo "Bienvenue, " . $_SESSION["login"];
    }
    
    if (isset($_REQUEST["modifmdp"])) {
        echo "Votre mot de passe a été modifié.";
    }
    ?>
    
    <p>
        <a href='index.php?controller=user&action=logout'><button>Logout</button></a>
        <a href='index.php?controller=user&action=profil'><button>Informations profil</button></a>
    </p>
</h4>

<p>
    <?php 
    echo '<ul>';
    
    foreach ($data as $oneData) {
        echo '<li>';
        echo $oneData['jour'] . " " . $oneData['date'] . " " . $oneData['heure']; 
        
        if ($_REQUEST["action"] == "arrivee") {
            echo " " . $oneData['depart'];
        } elseif ($_REQUEST["action"] == "depart") {
            echo " " . $oneData['retour'];
        }
        
        echo '</li>';
    }
    
    echo '</ul>';
    ?>
    
</p>

<p>
	<a href='index.php?controller=default&action=arrivee'><button>Offres Arrivees Entreprise</button></a>
    <a href='index.php?controller=default&action=depart'><button>Offres Depart Entreprise</button></a>
    <a href='index.php?controller=default&action=mesoffres'><button>Mes Offres</button></a>
</p>