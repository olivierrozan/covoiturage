<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <h1>
                <?php 
                echo $title;
                ?>
            </h1>
            
            <div style="color:green; font-weight:bold; font-size:20px;">
                <?php
                if (isset($_GET['modif'])) {
                    echo "Profil modifié";
                }
                ?>
            </div>
            <hr/>
            <!-- Infos profil : Vertical tab -->
            <div  class="col-sm-7">
                
                <div class="col-xs-3"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#home" data-toggle="tab">Général</a></li>
                        <li><a href="#profile" data-toggle="tab">Compte</a></li>
                    </ul>
                </div>

                <div class="col-xs-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <p>
                                <?php
                                echo "Nom : " . $profil["nom"] . "<br>";
                                echo "Prenom : " . $profil["prenom"] . "<br>";
                                echo "Adresse : " . $profil["adresse"] . " " . $profil["codePostal"] . " " . $profil["ville"] . "<br>";
                                echo "Email : " . $profil["email"] . "<br>";
                                echo "Téléphone : " . $profil["tel"] . "<br>";
                                echo "Voiture : " . $profil["voiture"] . ", " . $profil["places"] . " places au total<br>";
                                ?>
                            </p>

                            <p>
                                <a href='index.php?controller=profil&action=modifierprofil'><button class="btn btn-sm btn-primary">Modifier profil</button></a>
                                <a href='index.php?controller=profil&action=modifiermotdepasse'><button class="btn btn-sm btn-primary">Modifier mot de passe</button></a>
                            </p>
                        </div>
                        <div class="tab-pane" id="profile">
                            <p>
                                
                            </p>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            
        </div>
    </div>
</section>