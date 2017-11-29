<?php
/*
 * !! A SUPPRIMER LORS DU DEPLOIEMENT !!
 * jdurand : aaaaaa
 * jduval : bbbbbb
 * lahmad : cccccc
 * Admin : admin59
 * orozan : OzTprP
 */
?>

<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <h1>
                <?php 
                echo $title;
                ?>
            </h1>
            
            <p style="color:red;">
                <?php
                if (isset($_REQUEST["error"])) {
                    echo "Mot de passe incorrect";
                }
                ?>
            </p>

            <p>
                <a href='index.php?controller=user&action=createuser'><button class="btn btn-sm btn-primary">Pas encore inscrit?</button></a>
            </p>
            
            <form action="?controller=user&action=login" method="POST">

                <label>Email : </label><br>
                <input type="text" name="login" class="form-control input" value="rozan.olivier@gmail.com"/><br>

                <label>Mot de Passe : </label><br>
                <input type="password" name="password" class="form-control input" value="OzTprP"/><br><br>

                <input type="submit" class="btn btn-sm btn-primary" name="LOGIN"/>
            </form>
        </div>
    </div>
</section>