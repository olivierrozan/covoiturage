<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>CoVoiturage</title>
        
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
        <script type="text/javascript" src="include/jquery-2.1.4.js"></script>
        
        <script src="include/jquery.geocomplete.js"></script>
        <script src="include/logger.js"></script>
        
        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" href="include/bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="include/font-awesome/css/font-awesome.min.css" type="text/css">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="include/css/owl.carousel.css" type="text/css">
        <link rel="stylesheet" href="include/css/owl.theme.css" type="text/css">
        <link rel="stylesheet" href="include/css/owl.transitions.css" type="text/css">
        <!-- Css3 Transitions Styles  -->
        <link rel="stylesheet" type="text/css" href="include/css/animate.css">
        <!-- Lightbox CSS -->
        <link rel="stylesheet" type="text/css" href="include/css/lightbox.css">
        <!-- Responsive CSS Style -->
        <link rel="stylesheet" type="text/css" href="include/css/responsive.css">
        <!-- Sulfur CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="include/css/style.css">
        
        <script src="include/js/modernizrr.js"></script>
        
    </head>
    <body>
        <?php
        echo "<header class='clearfix'><div class='navbar navbar-default navbar-top'>";
        echo "<div class='container'><div class='navbar-collapse collapse'>"
        . "<div class='navbar-header'>"
        . "<a class='navbar-brand'>CoVoiturage</a>"
        . "</div>"
        . "<ul class='nav navbar-nav navbar-right'>";
        echo " <li><a href='index.php?controller=offers&action=index'>Recherche</a></li>";
        
        if (isset($_SESSION["uid"])) {
            echo " <li><a href='index.php?controller=user&action=logout'>Se Déconnecter</a></li> ";
            echo " <li><a href='index.php?controller=offers&action=mesoffres'>Mes Offres</a></li> ";
            echo " <li><a href='index.php?controller=user&action=profil'>Profil</a></li> ";
        } else {
            echo " <li><a href='index.php?controller=user&action=login'>Se Connecter</a></li> ";
        }
        
        echo " <li><a href='index.php?controller=user&action=createuser'>S'inscrire</a></li>";
        echo "</ul></div></div></header>";
        
        echo '<div class="page-header"></div>';
    
        echo $content;
        ?>
    </body>
    
    <!-- Start CCopyright Section -->
        <div id="copyright-section" class="copyright-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="copyright">
                            Copyright © 2016
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="copyright-menu pull-right">
                            <ul>
                                <li>Email : name@domain.com</li>
                                <li>Tel : 00.00.00.00.00</li>
                            </ul>
                        </div>
                    </div>
                </div><!--/.row -->
            </div><!-- /.container -->
        </div>
        <!-- End CCopyright Section -->
    
</html>