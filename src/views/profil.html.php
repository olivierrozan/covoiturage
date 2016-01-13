<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?php 
                    echo $title;
                    ?>
                </h1>
            </div>
            
            <h3>
                <?php
                if (isset($_GET['modif'])) {
                    echo "Profil modifié";
                }
                ?>
            </h3>

            <p>
                <?php
                echo "Email : " . $profil["email"] . "<br><br>";
                echo "Login : " . $profil["login"] . "<br><br>";
                echo "Nom : " . $profil["nom"] . "<br><br>";
                echo "Prenom : " . $profil["prenom"] . "<br><br>";
                echo "Téléphone : " . $profil["tel"] . "<br><br>";
                ?>
            </p>

            <p>
                <a href='index.php?controller=user&action=logout'><button class="btn btn-sm btn-primary">Logout</button></a>
                <a href='index.php?controller=user&action=modifierprofil'><button class="btn btn-sm btn-primary">Modifier profil</button></a>
            </p>
        </div>
    </div>
</section>