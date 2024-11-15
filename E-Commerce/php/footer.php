<?php $optionsMenu = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'GET',
    ],
];

// Création du contexte HTTP
$contextMenu = stream_context_create($optionsMenu);

// URL de l'API
$apiUrlMenu = 'http://localhost:8000/api/Categories/all';

// Envoyer la requête HTTP sans le jeton
$resultMenu = file_get_contents($apiUrlMenu, false, $contextMenu);

// Vérifier si la requête a réussi
if ($resultMenu === FALSE) {
    die('Erreur lors de l\'appel de l\'API.');
}

$jsonDataMenu = json_decode($resultMenu, true);

if ($jsonDataMenu === null) {
    die('Erreur lors du décodage du JSON.');
}

// Afficher la réponse de l'API sous forme de tableau

?>

<div class="row">
    <div class="span3">
        <h4>Navigation</h4>
        <ul class="nav">
        <?php for ($i = 0; $i < count($jsonDataMenu); $i++) : ?>
                <?php
                    $currentItemMenu = $jsonDataMenu[$i];
                    $idCategorieMenu= $currentItemMenu["idCategorie"];
                    $nomcategorieMenu = $currentItemMenu["nomCategorie"];
                    ?>
            <li><a href="./products.php?categorieId=<?php echo $idCategorieMenu; ?>"><?php echo $nomcategorieMenu; ?></a></li>	
            
            <?php endfor; ?>
            <li><a href="./products.php">CONTACT</a></li>						
        </ul>					
    </div>
    <div class="span4">
        <h4></h4>
        <!---<ul class="nav">
            <li><a href="#">My Account</a></li>
            <li><a href="#">Order History</a></li>
            <li><a href="#">Wish List</a></li>
            <li><a href="#">Newsletter</a></li>
        </ul>--->
    </div>
    <div class="span5">
        <p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
        <div style="text-align: justify;">
            <p>
            Nous avons sélectionné des produits de première qualité, alliant confort et esthétisme. Chaque vêtement a été pensé dans le respect de l'éthique et de l'environnement.
            </p>
        </div>
        <br/>
        <span class="social_icons">
            <a class="facebook" href="#">Facebook</a>
            <a class="twitter" href="#">Twitter</a>
            <a class="skype" href="#">Skype</a>
            <a class="vimeo" href="#">Vimeo</a>
        </span>
    </div>					
    
</div>	