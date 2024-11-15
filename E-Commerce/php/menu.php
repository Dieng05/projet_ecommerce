
<?php $optionsMenu = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'GET',
    ],
];
$contextMenu = stream_context_create($optionsMenu);
$apiUrlMenu = 'http://localhost:8000/api/Categories/all';
$resultMenu = file_get_contents($apiUrlMenu, false, $contextMenu);
if ($resultMenu === FALSE) {
    die('Erreur lors de l\'appel de l\'API.');
}
$jsonDataMenu = json_decode($resultMenu, true);

if ($jsonDataMenu === null) {
    die('Erreur lors du décodage du JSON.');
}
?>

<div class="navbar-inner main-menu">				
    <a href="index.html" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo" alt=""></a>
    <nav id="menu" class="pull-right">
        <ul>

            <li><a href="./index.php">HOME</a></li>

            <?php for ($i = 0; $i < count($jsonDataMenu); $i++) : ?>
                <?php
                    $currentItemMenu = $jsonDataMenu[$i];
                    $idCategorieMenu= $currentItemMenu["idCategorie"];
                    $nomcategorieMenu = $currentItemMenu["nomCategorie"];
                    ?>
            <li><a href="./products.php?categorieId=<?php echo $idCategorieMenu; ?>"><?php echo $nomcategorieMenu; ?></a></li>	
            
            <?php endfor; ?>
            <li><a href="#">CONTACT</a></li>
                
        </ul>
    </nav>
</div>