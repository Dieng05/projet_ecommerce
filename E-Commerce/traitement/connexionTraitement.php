<?php 

if (!isset($_SESSION['token'])) {
    if (isset($_POST['submit'])) { 
        $userData = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];
    
        
        $username=$userData['username'];
    
        $jsonData = json_encode($userData);
    
        $options = [
            'http' => [
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => $jsonData,
                
            ],
        ];
    
        $context = stream_context_create($options);
    
        $result = file_get_contents('http://localhost:8080/api/authenticate', false, $context);
    
        if ($result === FALSE) {
            header("Location: ../connexion.php");
            die('Erreur lors de l\'appel de l\'API.');
        }
        session_start();
    
       /* echo '<pre>';
        echo htmlspecialchars($result);  
        echo '</pre>';*/
       
        $jsonData = json_decode($result, true);
            if ($jsonData === null) {
                die('Erreur lors du décodage du JSON.');
            }
    
        
        if (isset($jsonData['id_token'])) {
            
            $_SESSION['token'] = $jsonData['id_token'];
            $_SESSION['login'] = $username;
            /*echo '<pre>';
            echo htmlspecialchars('le token est '.$_SESSION['token']);  
            echo '</pre>';*/
            header("Location: ../client.php?username=$username");    
        
        } else {
            die('Clé "id_token" non trouvée dans le JSON.');
        }
            
    
    
    }
    
}
else{
     header("Location: ../index.php");
}




?>