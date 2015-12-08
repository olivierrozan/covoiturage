<h1>
    <?php 
    echo $title;
    ?>
</h1>

<h4>
    <?php
    if (isset($_REQUEST["login"])) {
        echo "Bienvenue, " . $_REQUEST["login"];
    }
    
    if (isset($_REQUEST["modifmdp"])) {
        echo "Votre mot de passe a été modifié.";
    }
    ?>
</h4>

<p>
    <?php 
    foreach ($data as $oneData) {
        echo '<li>';
        echo $oneData['id'] . " " . $oneData['email']; 
        echo '</li>';
    }
    ?>
</p>

<p>
	<a href='index.php?controller=user&action=logout'><button>Logout</button></a>
</p>

<p>
	<a href='index.php?controller=user&action=profil'><button>Informations profil</button></a>
</p>