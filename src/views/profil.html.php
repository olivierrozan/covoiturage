<h1>
    <?php
    echo $data["title"];
    ?>
</h1>

<p>
    <?php
    echo "Email : " . $profil["email"] . "<br>";
    echo "Login : " . $profil["login"] . "<br>";
    echo "nom : " . $profil["nom"] . "<br>";
    echo "prenom : " . $profil["prenom"] . "<br>";
    echo "Téléphone : " . $profil["tel"] . "<br>";
    ?>
</p>

<p>
	<a href='index.php?controller=user&action=logout'><button>Logout</button></a>
</p>

<p>
	<a href='index.php?controller=default&action=index'><button>Retour Index</button></a>
</p>

<p>
	<a href='index.php?controller=user&action=modifierprofil'><button>Modifier profil</button></a>
</p>