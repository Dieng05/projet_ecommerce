<?php session_start();
    
    if(isset($_SESSION['login'])){
        $token = $_SESSION['token']; 
        if(($_SESSION['login'])!=='admin'){

            header("Location: ../index.php");
            exit();
            }
           
     //echo  $_SESSION['login'];

     $login=$_SESSION['login'];

     $options1 = [
        'http' => [
			'header' => "Content-type: application/json\r\n",
			'method' => 'GET',
		],
    ];

    $context1 = stream_context_create($options1);

	// Envoyer la requête HTTP avec le jeton
	$result1 = file_get_contents("http://localhost:8080/api/admin/users/$login", false, $context1);

    $jsonData1 = json_decode($result1, true);
    $idUser =  $jsonData1['id'];
	if ($jsonData1 === null) {
		die('Erreur lors du décodage du JSON.');
	}

	// Afficher la réponse de l'API sous forme de tableau
	echo '<pre>';
	print_r($idUser);
	echo '</pre>';

    $options2 = [
        'http' => [
            'header' => "Content-type: application/json\r\n" .
                        "Authorization: Bearer $token\r\n",  // Ajoutez l'en-tête d'autorisation avec le jeton
                        'method' => 'GET',
        ],
    ];
    $context2 = stream_context_create($options2);

	// Envoyer la requête HTTP avec le jeton
	$result2 = file_get_contents("http://localhost:8080/api/clients/getClientId/$idUser", false, $context2);
       
    $Commande = [
        'dateCommande' => "2023-12-21T13:54:36.222Z",
        'client' => [
            'id' => $result2,          
        ],
    ];
    $jsonData3 = json_encode($Commande);

    $options3 = [
        'http' => [
            'header' => "Content-type: application/json\r\n" .
                        "Authorization: Bearer $token\r\n",  // Ajoutez l'en-tête d'autorisation avec le jeton
                        'method' => 'POST',
                        'content' => $jsonData3,
        ],
    ];
    $context3 = stream_context_create($options3);
    $result3 = file_get_contents('http://localhost:8080/api/commandes', false, $context3);

    echo $result3;

    if(isset($_SESSION['login'])=='admin'){

    header("Location: ../commande.php");
    }
    if(isset($_SESSION['login'])!='admin'){

        header("Location: ../index.php");
        }
       

} 

else {
    header("Location: ../connexion.php");
    die('Token non trouvé dans la session.');
}


?>
    