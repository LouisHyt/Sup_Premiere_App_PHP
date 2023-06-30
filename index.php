<?php

    if(isset($_GET["route"])){
        $currentRoute = $_GET["route"];
    } else {
        $currentRoute ="dashboard";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="styles/main.css">
    <title>Ajouts produit</title>
</head>
<body>
    <?php include_once("navigation.php") ?>
    <div class="container">
        <?php include_once("$currentRoute.php") ?>
        <?php 
            if(isset($_SESSION["message"])){
                switch($_SESSION["message"]["success"]){
                    case true :
                        echo "<div class='ui green message'>".$_SESSION["message"]["text"]."</div>";
                        break;
                    case false :
                        echo "<div class='ui red message'>".$_SESSION["message"]["text"]."</div>";
                        break;
                }
                unset($_SESSION["message"]);
            }
        ?>
    </div>
    
</body>
</html>