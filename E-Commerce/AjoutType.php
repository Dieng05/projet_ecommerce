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


			

            
		
			<section class="main-content">							
				<div class="row">									
						<div class="span5">					
							<h4 class="title"><span class="text"><strong>Ajouter</strong> Une Categorie</span></h4>
							<form action="traitement/categorieTraitement.php" method="post">
								<input type="hidden" name="next" value="/">
								<fieldset>
									<div class="control-group">
										<label class="control-label">Categorie</label>
										<div class="controls">
											<input type="text" placeholder="Categorie" name="categorie" id="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<input tabindex="3" class="btn btn-inverse large" type="submit" value="Sign into your account">
										<hr>
									</div>
								</fieldset>
							</form>				
						</div>
						<div class="span7">					
							<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
							<form  method="POST" action="traitement/produitTraitement.php" enctype="multipart/form-data" >
								<fieldset>
									<div class="control-group">
										<!--<label class="control-label">Nom du Produit :</label>-->
										<div class="controls">
											<input type="text" name="nom" placeholder="Nom du Produit" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<!--<label class="control-label">Description du produit :</label>-->
										<div class="controls">
											<input type="text" name="description" placeholder="Description du produit" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<!--<label class="control-label">Password:</label>--->
										<div class="controls">
											<input type="number" name="prix" placeholder="Prix du produit" class="input-xlarge">
										</div>
									</div>	
									<div class="control-group">
										<!--<label class="control-label">Password:</label>--->
										<div class="controls">

										<input type="text" name="image" placeholder="Saisir Image image" class="input-xlarge"/>

										</div>
									</div>	
									<div class="control-group">
										<!--<label class="control-label">Password:</label>--->
										<div class="controls">

											<select name="categorie" class="input-xlarge">
                                             <?php for ($i = 0; $i < count($jsonDataMenu); $i++) : 
                                                $currentItemMenu = $jsonDataMenu[$i];
                                                $idCategorieMenu= $currentItemMenu["id"];
                                                $nomcategorieMenu = $currentItemMenu["nomCategorie"];
                                                ?>
												<option value="<?php echo $idCategorieMenu; ?>"><?php echo $nomcategorieMenu; ?></option>
                                                <?php endfor; ?>
												
											</select>
										</div>
									</div>							                            
									<!--<div class="control-group">
										<p>Now that we know who you are. I'm not a mistake! In a comic, you know 
											how you can tell who the arch-villain's going to be?</p>
									</div>-->
									<hr>
									<div class="">
										<input type="submit" class="btn btn-inverse large"  value="Create your account"/>
									</div>
								</fieldset>
								    
							</form>					
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
