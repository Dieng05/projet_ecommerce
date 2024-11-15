<?php 

session_start();

if (isset($_SESSION["token"])) {
    $token = $_SESSION['token'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        if (isset($_FILES["image1"])) {
            $Image = $_FILES['image1']['name'];
            $file_tmp_name = $_FILES['image1']['tmp_name'];
            $destination_path = "../images/" . $Image;
    
            
            if ($_FILES['image1']['error'] === UPLOAD_ERR_OK) {
                
                if (move_uploaded_file($file_tmp_name, $destination_path)) {
                    
                    echo "L'image a été téléchargée avec succès.";
                   
                } else {
                   
                    echo "Erreur lors du déplacement du fichier vers la destination.";
                }
            } else {
                
                echo "Erreur lors du téléchargement du fichier.";
            }
        } else {
            
            echo "Le champ 'image1' n'a pas été trouvé dans le formulaire.";
        }
    }
    
    $userData = [
        'nomProduit' => $_POST['nom'],
        'descriptionProduit' => $_POST['description'],
        'prixProduit' => (int)$_POST['prix'],
        //'imageProduit' => [$Image], // Mettez l'image dans un tableau
        'imageProduitContentType' =>$_POST['image'],
        'categorie' => [
            'id' => (int)$_POST['categorie'],
        ],
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
    $result = file_get_contents('http://localhost:8080/api/produits', false, $context);
    
    header("Location: ../index.php");
    
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