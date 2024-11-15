<?php 

// Configuration des options de contexte HTTP sans l'en-tête Authorization
$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'GET',
    ],
];

// Création du contexte HTTP
$context = stream_context_create($options);

// URL de l'API
$apiUrl = 'http://localhost:8000/api/produits/all';

// Envoyer la requête HTTP sans le jeton
$result = file_get_contents($apiUrl, false, $context);

// Vérifier si la requête a réussi
if ($result === FALSE) {
    die('Erreur lors de l\'appel de l\'API.');
}

$jsonData = json_decode($result, true);

if ($jsonData === null) {
    die('Erreur lors du décodage du JSON.');
}

// Afficher la réponse de l'API sous forme de tableau


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
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		



	    <!-----------top Bar ----------------->
		<?php include 'php/topBar.php';  ?>

		<div id="wrapper" class="container">

		<!----- Menu --------------------------->

			<section class="navbar main-menu">
				<?php include 'php/menu.php';  ?>
			</section>

			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="images/Baniere1.jpg" alt="" width="100%" style="height: 35em !important;"/>
							<div class="intro">
								<h1>Promo Fin d'Année</h1>
								<p><span> 30%  de reduction</span></p>
								<p><span>sur chaque 4 articles achetés</span></p>
							</div>
						</li>
						<li>
							<img src="images/Baniere2.jpg" alt="" width="100%" style="height: 35em !important;"/>
							<div class="intro">
								<h1>Promo Fin d'Année</h1>
								<p><span> 30%  de reduction</span></p>
								<p><span>sur chaque 4 articles achetés</span></p>
							</div>
						</li>
						<li>
							<img src="images/Baniere3.jpg" alt="" width="100%" style="height: 35em !important;"/>
							<div class="intro">
								<h1>Promo Fin d'Année</h1>
								<p><span> 30%  de reduction</span></p>
								<p><span>sur chaque 4 articles achetés</span></p>
							</div>
						</li>
					</ul>
				</div>			
			</section>
			<section class="header_text">
			
            <p style="text-align:center;">
            Nous avons sélectionné des produits de première qualité, alliant confort et esthétisme. 
            </p>
        
			</section>
			<section class="main-content">
			<div class="row">						
				<div class="span6">
				<img src="images/Tel1.jpg" alt="" width="100%" style="height: 22em !important;"/>

				</div>

				<div class="span6">
                <img src="images/Tel2.jpg" alt="" width="100%" style="height: 22em !important;"/>

				</div>
			</div>
			<br>
				<div class="row">						
					<div class="span12">								
						<ul class="thumbnails listing-products">
						<?php
						$parPage = 8;
						$val_nombre = count($jsonData);
						$pages = ceil($val_nombre / $parPage);

						if (isset($_GET['page']) && !empty($_GET['page'])) {
							$currentPage = (int) strip_tags($_GET['page']);
						} else {
							$currentPage = 1;
						}

						$premier = ($currentPage - 1) * $parPage;

						?>

						<?php $portionData = array_slice($jsonData, $premier, $parPage);
						foreach ($portionData as $item) {

							//$currentItem = $jsonData[$i];
							$idProduit= $item["idProduit"];
							$nomProduit = $item["nomProduit"];
							$descriptionProduit = $item["descriptionProduit"];
							$prixProduit = $item["prixProduit"];
							$imageProduit = $item["imageProduit"];  ?>

							<li class="span3">
                            
								<div class="product-box">
									<span class="sale_tag"></span>												
								
									<a href="product_detail.php?idProduit=<?php echo $idProduit; ?>">
									<img alt="" src="images/<?php echo $imageProduit; ?>" width="100%" style="height: 200px !important;">

									</a>
								
                                    <br/>
									<a href="product_detail.php?idProduit=<?php echo $idProduit; ?>" class="title"><?php echo $nomProduit; ?></a><br/>
									<a href="product_detail.php?idProduit=<?php echo $idProduit; ?>" class="category"><?php echo $descriptionProduit; ?></a>
									<p class="price"><?php echo $prixProduit; ?></p>
								</div>
							</li> 
							
						<?php }
						?>
                                          
						</ul>								
						<hr>

						<div class="pagination pagination-small pagination-centered">
							<ul>
								<li class="active <?= ($currentPage == 1) ? "disabled" : "" ?>">
									<a href="index.php?page=<?= $currentPage - 1 ?>">Prev</a>
								</li>
								<?php for ($page = 1; $page <= $pages; $page++) : ?>
									<li class="<?= ($page == $currentPage) ? "active" : "" ?>">
										<a href="index.php?page=<?= $page ?>"><?= $page ?></a>
									</li>
								<?php endfor ?>
								<li class="<?= ($currentPage == $pages) ? "disabled" : "" ?>">
									<a href="index.php?page=<?= $currentPage + 1 ?>">Next</a>
								</li>
							</ul>
						</div>
					
				</div>
						
			</section>
			
			<section id="footer-bar">
				<!---------------Footer --------------->

				<?php include 'php/footer.php';  ?>


			</section>


            <!------- Copyright ------------>
			<?php include 'php/copyRigth.php';  ?>
			
		</div>
		<script src="themes/js/common.js"></script>
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
    </body>
</html>