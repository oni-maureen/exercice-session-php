<?php
session_start();

if(!isset($_SESSION["visites"])) {
    $_SESSION["visites"] = 0; 
}

if(!isset($_SESSION["connecté"])) {
    $_SESSION["connecté"] = false;
}

$login = "root"; 
$login_mdp = "root2"; 
require_once ("affichage-page.php"); 


if ($_SESSION["connecté"] === true) {
    echo "vous êtes bien connecté";
    affichagePage(); 
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin = filter_input(INPUT_POST, "admin", FILTER_SANITIZE_SPECIAL_CHARS );
    $admin_mdp = filter_input(INPUT_POST, "admin_mdp", FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($admin) && isset($admin_mdp)) {
        if (trim($admin) == "" || trim($admin_mdp) == "") {
            echo "vous n'avez pas rempli les champs";
        } else {
            $userConnecté = ($admin == $login && $admin_mdp == $login_mdp); 

            if ($userConnecté) {
                $_SESSION["connecté"] = true;
                $_SESSION["visites"]++; 
                affichagePage(); 
            } else {
                echo "votre login ou mot de passe n'est pas correct";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo Session</title>
</head>
<body>
    <?php if (!$_SESSION["connecté"]) : ?>
    <form method="POST">
        <label for="admin">Pseudo</label>
        <input type="text" name="admin">
        <label for="admin_mdp">Mot de passe</label>
        <input type="text" name="admin_mdp">
        <button type="submit">Envoyer</button>
    </form>
    <?php endif; ?>
</body>
</html>


<?php




/*

tentative 1 : je voulais utiliser le nombre de visites mais ce n'était pas viable pour représenter si un utilisateur était connecté ou non


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin = filter_input(INPUT_POST,"admin", FILTER_SANITIZE_SPECIAL_CHARS );
    $admin_mdp = filter_input(INPUT_POST, "admin_mdp", FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($admin) && isset($admin_mdp)) {
        if (trim($admin) == "" || trim($admin_mdp) == "") {
            echo "vous n'avez pas rempli les champs";
        } elseif ($admin == $login && $admin_mdp == $login_mdp) {
            session_start();
            $id = session_id();
            if(!isset($_SESSION["visites"])) {
                $_SESSION["visites"] = 0; 
            }
            $_SESSION["visites"]++; 
            $visites = $_SESSION["visites"];
            if ($visites > 0) {
                echo "c'est bon vous êtes bien connecté"; 
                echo $visites; 
                echo ?> 
            
                <?php

            } else {
                echo "votre login ou mot de passe n'est pas correct"; 

            }
        } else {
            echo "votre login ou mot de passe n'est pas correct"; 

        }
    }

} */
?>
