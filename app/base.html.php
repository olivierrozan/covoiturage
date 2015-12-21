<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>CoVoiturage</title>
        <script src="include/jquery-2.1.4.js"></script>
    </head>
    <body>
        <?php
        if (isset($_SESSION["uid"])) {
            echo "<a href='index.php?controller=user&action=logout'><button>Se Déconnecter</button></a>";
        } else {
            echo "<a href='index.php?controller=user&action=login'><button>Se Connecter</button></a>";
        }
        
        echo $content;
        ?>
    </body>
    <footer style="margin-top:10px;">
        2015 covoiturage
    </footer>
</html>