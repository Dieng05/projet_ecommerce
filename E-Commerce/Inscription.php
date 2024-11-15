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
		    <section class="navbar main-menu">
				<?php include 'php/menu.php';  ?>
			</section>	
			<!--<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>Login or Regsiter</span></h4>
			</section>-->		
			<section class="main-content">				
				<div class="row">
					<!--<div class="span5">					
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<form action="#" method="post">
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Username</label>
									<div class="controls">
										<input type="text" placeholder="Enter your username" id="username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Username</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" id="password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" value="Sign into your account">
									<hr>
									<p class="reset">Recover your <a tabindex="4" href="#" title="Recover your username or password">username or password</a></p>
								</div>
							</fieldset>
						</form>				
					</div>--->
					<div class="span12">					
						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
                       
						<form action="traitement/inscriptionTraitement.php" method="post" class="form-stacked">
							<fieldset>
								<div class="control-group">
									<!--<label class="control-label">Username</label>--->
									<div class="controls">
										<input type="text" name="login" placeholder="login" class="input-xlarge"/>
									</div>
								</div>
								<div class="control-group">
									<!--<label class="control-label">First Name:</label>--->
									<div class="controls">
										<input type="text" name="firstName" placeholder="FirstName" class="input-xlarge"/>
									</div>
								</div>
                                <div class="control-group">
									<!--<label class="control-label">Last Name:</label>--->
									<div class="controls">
										<input type="text" name="lastName" class="input-xlarge" placeholder="LastName"/>
									</div>
								</div>	
								<div class="control-group">
									<!--<label class="control-label">Adresse:</label>---->
									<div class="controls">
										<input type="text" name="adresse" class="input-xlarge" placeholder="Adresse"/>
									</div>
								</div>	
								<div class="control-group">
									<!--<label class="control-label">telephone:</label>--->
									<div class="controls">
										<input type="number" name="telephone" class="input-xlarge" placeholder="telephone"/>
									</div>
								</div>	
                                <div class="control-group">
									<!--<label class="control-label">Email :</label>---->
									<div class="controls">
										<input type="email" name="email" placeholder="Email" class="input-xlarge">
									</div>
								</div>	
								<div class="control-group">
									<!--<label class="control-label">Password :</label>--->
									<div class="controls">
										<input type="password" name="password" placeholder="Password" class="input-xlarge">
									</div>
								</div>							                            
								<div class="actions">
                                    <input name="submit" tabindex="9" class="btn btn-inverse large" type="submit" value="Create your account">
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
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.html";
				})
			});
		</script>		
    </body>
</html>