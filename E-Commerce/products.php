<?php 

$idCategorie = $_GET['categorieId'];


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
$apiUrl = "http://localhost:8000/api/produits/categorie/$idCategorie";

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


		<!-- global styles -->
		
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<!-----------top Bar ----------------->
		<?php include 'php/topBar.php';  ?>



		<div id="wrapper" class="container">
		    <section class="navbar main-menu">
				<?php include 'php/menu.php';  ?>
			</section>
			<section class="header_text sub">
			<!--<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >--->
				<h4><span>New products</span></h4>
			</section>
			<section class="main-content">
				
				<div class="row">						
					<div class="span12">								
						<ul class="thumbnails listing-products">

						<?php
						$parPage = 9;
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
						foreach ($portionData as $item){  ?>
                       
							<li class="span4">
                            <?php
                               
								$idProduit= $item["idProduit"];
								$nomProduit = $item["nomProduit"];
								$descriptionProduit = $item["descriptionProduit"];
								$prixProduit = $item["prixProduit"];
								$imageProduit = $item["imageProduit"];  
								?>

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
                            <?php } ?>
                           
						</ul>								
						<hr>
						<div class="pagination pagination-small pagination-centered">
							<ul>
								<li class="active <?= ($currentPage == 1) ? "disabled" : "" ?>">
									<a href="products.php?categorieId=<?php echo $idCategorie; ?>&page=<?= $currentPage - 1 ?>">Prev</a>
								</li>
								<?php for ($page = 1; $page <= $pages; $page++) : ?>
									<li class="<?= ($page == $currentPage) ? "active" : "" ?>">
										<a href="products.php?categorieId=<?php echo $idCategorie; ?>&page=<?= $page ?>"><?= $page ?></a>
									</li>
								<?php endfor ?>
								<li class="<?= ($currentPage == $pages) ? "disabled" : "" ?>">
									<a href="products.php?categorieId=<?php echo $idCategorie; ?>&page=<?= $currentPage + 1 ?>">Next</a>
								</li>
							</ul>
						</div>
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