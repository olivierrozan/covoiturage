<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>CoVoiturage</title>
        
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
        <script type="text/javascript" src="include/jquery-2.2.4.js"></script>
        
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
        
        
        
        <link rel="stylesheet" href="include/bootstrap.vertical-tabs.css">

        <link rel="stylesheet" type="text/css" href="include/css/style.css">
        
        <script src="include/js/modernizrr.js"></script>
        <script src="include/bootstrap/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Login</h4>
					</div>
					<div class="modal-body">
						 
						<form action="?controller=user&action=login" method="POST">
							<label>Email : </label><br>
							<input type="text" name="login" class="form-control input" value="rozan.olivier@gmail.com"/><br>

							<label>Mot de Passe : </label><br>
							<input type="password" name="password" class="form-control input" value="OzTprP"/><br><br>

							<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Annuler</button>
							<input type="submit" class="btn btn-sm btn-primary" name="LOGIN"/>
						</form>
					</div>
					
				</div>
			</div>
		</div>
		
		<header class='clearfix'><div class='navbar navbar-default navbar-fixed-top'>
			<div class='container'>
				<div class='navbar-collapse collapse'>
					<div class='navbar-header'>
						<a class='navbar-brand'>CoVoiturage</a>
					</div>
					
					<ul class='nav navbar-nav navbar-right'>
                        <li><a href='index.php?controller=offers&action=index'>Recherche</a></li>
						
						<?php
						if (isset($_SESSION["uid"])) {
						?>
                        <li><a href='index.php?controller=offers&action=ajouteroffre'>Ajouter Offre</a></li>
                        <li><a href='index.php?controller=offers&action=mesoffres'>Mes Offres</a></li>
						<li><a href='index.php?controller=profil&action=profil'>Profil</a></li>
                        <li><a href='index.php?controller=user&action=logout'>Se Déconnecter</a></li>
                        <li class="welcome"><?php echo $_SESSION["login"] ?></li>
						<?php
						} else {
						?>
						<!--<li><a href='index.php?controller=user&action=login'>Se Connecter</a></li>-->
						<li><a href='*' data-toggle='modal' data-target='#basicModal'>Se Connecter</a></li>
						<li><a href='index.php?controller=user&action=createuser'>S'inscrire</a></li>
						<?php
						}
						?>
						
					</ul>
				</div>
			</div>
		</header>
		<div class="page-header"></div>
		<?php
        	echo $content;
        ?>
		
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
		<!-- End Copyright Section -->

    </body>
    
</html>