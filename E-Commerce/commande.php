<?php session_start();

if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];

    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n" .
                        "Authorization: Bearer $token\r\n",  // Concaténez les en-têtes correctement
            'method' => 'GET',
        ],
    ];

    // Création du contexte HTTP
    $context = stream_context_create($options);

    $result = file_get_contents('http://localhost:8080/api/commandes/commande', false, $context);

    // Vérifier si la requête a réussi
    if ($result === FALSE) {
        die('Erreur lors de l\'appel de l\'API.');
    }

    $jsonData = json_decode($result, true);

    if ($jsonData === null) {
        die('Erreur lors du décodage du JSON.');
    }

    // Utilisez $jsonData comme nécessaire

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

        <link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>
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
								<th>Prenom</th>
								<th>Nom</th>
								<th>Nom du produit</th>
								<th>Nom Categorie</th>
								<th>Telephone</th>
								<th>Date Commande</th>
							</tr>
						</thead>
						<tbody>
                        <?php
						$parPage = 10;
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
						foreach ($portionData as $item){

                            $prenom = $item["prenom"];
                            $nom= $item["nom"];
                            $nomProduit = $item["nomProduit"];
                            $nomCategorie = $item["nomCategorie"];
                            $telephone = $item["telephone"];
                            $dateCommande = $item["dateCommande"];
                             ?>
                        
					
                            
							<tr>
								<td><?php echo $prenom; ?></td>
								<td><?php echo $nom; ?></td>
                                <td><?php echo $nomProduit; ?></td>
								<td><?php echo $nomCategorie; ?></td>
                                <td><?php echo $telephone; ?></td>
								<td><?php echo $dateCommande; ?></td>							
							</tr>
                            <?php } ?>
						
						</tbody>
					</table>					
			</section>	
            <div class="pagination pagination-small pagination-centered">
							<ul>
								<li class="active <?= ($currentPage == 1) ? "disabled" : "" ?>">
									<a href="commande.php?page=<?= $currentPage - 1 ?>">Prev</a>
								</li>
								<?php for ($page = 1; $page <= $pages; $page++) : ?>
									<li class="<?= ($page == $currentPage) ? "active" : "" ?>">
										<a href="commande.php?page=<?= $page ?>"><?= $page ?></a>
									</li>
								<?php endfor ?>
								<li class="<?= ($currentPage == $pages) ? "disabled" : "" ?>">
									<a href="commande.php?page=<?= $currentPage + 1 ?>">Next</a>
								</li>
							</ul>
						</div>		
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


<?php } ?>