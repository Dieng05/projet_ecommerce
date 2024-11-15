<?php 

session_start();

if (isset($_SESSION["token"])) {
    $token = $_SESSION['token'];

    $userData = [
        'nomCategorie' => $_POST['categorie'],
    ];
    
    
    $jsonData = json_encode($userData);
    
    echo '<pre>';
    print_r($jsonData);
    echo '</pre>';
    
    
    
    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n" .
                        "Authorization: Bearer $token\r\n",  // Ajoutez l'en-tête d'autorisation avec le jeton
                        'method' => 'POST',
                        'content' => $jsonData,
        ],
    ];
    
    // Création du contexte HTTP
    $context = stream_context_create($options);
    
    // Envoyer la requête HTTP avec le jeton
    $result = file_get_contents('http://localhost:8080/api/categories', false, $context);
    
    header("Location: ../listeCategorie.php");
    
    // Vérifier si la requête a réussi
    if ($result === FALSE) {
        die('Erreur lors de l\'appel de l\'API.');
    }
    
    $jsonData = json_decode($result, true);
    
    if ($jsonData === null) {
        die('Erreur lors du décodage du JSON.');
    }
    
    // Afficher la réponse de l'API sous forme de tableau
    echo '<pre>';
    print_r($jsonData);
    echo '</pre>';
    
    
        echo '<pre>';
        echo htmlspecialchars('le token est '.$_SESSION['token']);  
        echo '</pre>';
    
        exit();


} else {
    die('Token non trouvé dans la session.');
}


?>