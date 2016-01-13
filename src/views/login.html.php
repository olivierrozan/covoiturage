<?php
/*
 * jdurand : aaaaaa
 * jduval : bbbbbb
 * lahmad : cccccc
 * jbieber : OcXjds
 * orozan : OzTprP
 */
?>

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
                if (isset($_REQUEST["error"])) {
                    echo "Mot de passe incorrect";
                }
                ?>
            </h3>

            <p>
                <a href='index.php?controller=user&action=createuser'><button class="btn btn-sm btn-primary">Pas encore inscrit?</button></a>
            </p>
            
            <form action="?controller=user&action=login" method="POST">

                <label>Login ou Email : </label><br>
                <input type="text" name="login" class="form-control input" value="orozan"/><br><br>

                <label>Mot de Passe : </label><br>
                <input type="password" name="password" class="form-control input" value="OzTprP"/><br><br>

                <input type="submit" class="btn btn-sm btn-primary" name="LOGIN"/>
            </form>
        </div>
    </div>
</section>