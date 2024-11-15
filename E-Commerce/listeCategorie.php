<?php 
session_start();
if(isset($_SESSION['token'])){
 $optionsMenu = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'GET',
        ],
    ];
    $contextMenu = stream_context_create($optionsMenu);
    $apiUrlMenu = 'http://localhost:8080/api/categories';
    $resultMenu = file_get_contents($apiUrlMenu, false, $contextMenu);
    if ($resultMenu === FALSE) {
        die('Erreur lors de l\'appel de l\'API.');
    }
    $jsonDataMenu = json_decode($resultMenu, true);
    
    if ($jsonDataMenu === null) {
        die('Erreur lors du décodage du JSON.');
    }
    ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		
		<!-- global styles -->
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/jquery.fancybox.css" rel="stylesheet"/>
				
		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<script src="themes/js/jquery.fancybox.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<!-----------top Bar ----------------->
		<div id="top-bar" class="container">
    <div class="row">
        <div class="span4">
            <form method="POST" class="search_form">
                <input type="text" class="input-block-level search-query" Placeholder="hanna do holl">
            </form>
        </div>
        <div class="span8">
            <div class="account pull-right">
                <ul class="user-menu">				
                    
                    
                    <?php
                     if (!isset($_SESSION['token'])) {	?>				
                    <li><a href="connexion.php">Login</a></li>
                    <li><a href="Inscription.php">Crer Un Compte</a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['token'])) {	?>				
                        <li><a href="traitement/deconnexion.php">logout</a></li>	
                    <?php } ?>	
                    	
                </ul>
            </div>
        </div>
    </div>
</div>





		<div id="wrapper" class="container">
            <section class="navbar main-menu">

				<?php include 'php/menu.php';  ?>
			
            </section>


            <div class="row">
				
				<div class="span12">
					<a href="AjoutType.php">
						Ajouter Categorie/Produit
					</a>
                    &nbsp&nbsp&nbsp&nbsp
					<a href="listeCategorie.php">
						ListeCategorie
					</a>
					&nbsp&nbsp&nbsp&nbsp
					<a href="commande.php">
						ListeCommande
					</a>
				</div>
            </div>


				
			
			<section class="main-content">				
				
					<table class="table table-striped table-bordered"> 
						<thead>
							<tr>
								<th>Code Produit</th>
								<th>Nom Categorie</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php for ($i = 0; $i < count($jsonDataMenu); $i++) : 
                            $currentItemMenu = $jsonDataMenu[$i];
                            $idCategorieMenu= $currentItemMenu["id"];
                            $nomcategorieMenu = $currentItemMenu["nomCategorie"];
                            ?>
                            
							<tr>
								<td><?php echo $idCategorieMenu; ?></td>
								<td><?php echo $nomcategorieMenu; ?></td>
								<td style="width: 18%;">
								    <a href="traitement/suppressionCategorie.php?idCat=<?php echo $idCategorieMenu; ?>" >
									  <img alt="" src="images/supprimer.png" width="20%" style="height: 15px !important;">
									</a>
									<a href="#" >
									  <img alt="" src="images/crayon.png" width="20%" style="height: 15px !important;">
									</a>
									
								</td>
							</tr>
                            <?php endfor; ?>
						
						</tbody>
					</table>					
			</section>			
			<section id="footer-bar">
				<!---------------Footer --------------->

				<?php include 'php/footer.php';  ?>


			</section>
			 <!------- Copyright ------------>
             <?php include 'php/copyRigth.php';  ?>
		</div>
		<script src="themes/js/common.js"></script>
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});
				
				$('#myCarousel-2').carousel({
                    interval: 2500
                });								
			});
		</script>
    </body>
</html>

<?php } ?>
