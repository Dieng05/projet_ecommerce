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
                    
                    
                    <?php session_start();
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