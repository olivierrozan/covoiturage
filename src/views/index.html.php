<h1>
    <?php 
    echo $title;
    ?>
</h1>

<section>
    <p>
        <?php
        if (!isset($_SESSION['uid'])) {
            echo "<a href='index.php?controller=user&action=login'><button>Se connecter</button></a>";
        }
        ?>
        
        <a href='index.php?controller=user&action=createuser'><button>S'inscrire</button></a>
    </p>
    
    <form action="?controller=default&action=offres" method="POST">
        <div class="depart">
            <label for="depart">Départ</label><br>
            <input id="depart" type="text" name="villeDepart" placeholder="départ"/>
        </div>

        <div class="arrivee">
            <br><label for="arrivee">Arrivée</label><br>
            <input id="arrivee" type="text" name="villeArrivee" placeholder="arrivée"/>
        </div><br>
        
        <div>
            <input type="submit" value="ok"/>
        </div>
    </form>
</section>
