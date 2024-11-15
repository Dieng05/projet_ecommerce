<?php 

session_start();

if (isset($_SESSION["token"])) {
    $token = $_SESSION['token'];

   
   
$id = $_GET['idProduit'];
   
    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n" .
                        "Authorization: Bearer $token\r\n",  // Ajoutez l'en-tête d'autorisation avec le jeton
                        'method' => 'DELETE',
        ],
    ];
    
    // Création du contexte HTTP
    $context = stream_context_create($options);
    
    // Envoyer la requête HTTP avec le jeton
    $result = file_get_contents("http://localhost:8080/api/produits/$id", false, $context);
   header("Location: ../client.php");
    
    

} else {
    die('Token non trouvé dans la session.');
}


?>