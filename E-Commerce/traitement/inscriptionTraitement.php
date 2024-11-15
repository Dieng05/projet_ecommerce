<?php

if (isset($_POST['submit'])) {
    // Construire le tableau associatif des données du formulaire
    $userData = [
        'login' => $_POST['login'],
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];

    // Convertir le tableau associatif en JSON
    $jsonData = json_encode($userData);

    // Configurer les options de contexte HTTP
    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => $jsonData,
        ],
    ];
    
    // Créer le contexte HTTP
    $context = stream_context_create($options);
    
    // Envoyer la requête POST à l'API JHipster
    $result = file_get_contents('http://localhost:8080/api/register', false, $context);

	$options1 = [
        'http' => [
			'header' => "Content-type: application/json\r\n",
			'method' => 'GET',
		],
    ];

	$username = $_POST['login'];

	$context1 = stream_context_create($options1);

	// Envoyer la requête HTTP avec le jeton
	$result1 = file_get_contents("http://localhost:8080/api/admin/users/$username", false, $context1);

	// Vérifier si la requête a réussi
	if ($result1 === FALSE) {
		die('Erreur lors de l\'appel de l\'API.');
	}

	$jsonData1 = json_decode($result1, true);

	if ($jsonData1 === null) {
		die('Erreur lors du décodage du JSON.');
	}

	// Afficher la réponse de l'API sous forme de tableau
	/*echo '<pre>';
	print_r($jsonData1);
	echo '</pre>';*/

    

    // Vérifier si la requête a réussi
    if ($result === FALSE) {
        die('Erreur lors de l\'appel de l\'API.');
    }

	$bigintValue = intval($jsonData1['id']);


	$userDataClient = [
        'nom' => $_POST['firstName'],
        'prenom' => $_POST['lastName'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'email' => $_POST['email'],
        'user' => [
            'id' => $bigintValue, 
            
        ],
    ];

	$jsonData2 = json_encode($userDataClient);

    // Configurer les options de contexte HTTP
    $options2 = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => $jsonData2,
        ],
    ];

	$context2 = stream_context_create($options2);
    
    // Envoyer la requête POST à l'API JHipster
    $result2 = file_get_contents('http://localhost:8080/api/clients', false, $context2);
    header("Location: ../connexion.php");
    echo '<pre>';
	print_r($userDataClient);
	echo '</pre>';

	exit();
	

    // Afficher la réponse de l'API (facultatif)
    // Afficher la réponse de l'API
        /*echo '<pre>';
        print_r($result);
        echo '</pre>'; */  
}

?>