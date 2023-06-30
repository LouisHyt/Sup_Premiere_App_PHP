<?php
    session_start();
    if(isset($_GET['action'])){

        switch($_GET['action']){
            case "addProduct" :
                var_dump($_POST);
                if(!isset($_POST) || empty($_POST)){
                    $_SESSION["message"] = [
                        "success" => false,
                        "text" => "Vous n'avez pas accès à cette page ! Merci de passer par le formulaire pour ajouter un produit"
                    ];
                } else {
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT);

                    if($name && $price && $quantity){
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "quantity" => $quantity,
                            'total' => $price * $quantity
                        ];

                        $_SESSION['products'][] = $product;
                        $_SESSION["message"] = [
                            "success" => true,
                            "text" => "Le produit a été ajouté avec succès !"
                        ];
                    } else {
                        $_SESSION["message"] = [
                            "success" => false,
                            "text" => "Erreur lors de l'ajout du produit: merci de respecter les champs du formulaire"
                        ];
                    }
                }
                header("Location:index.php");
                break;   
            case "deleteAllProduct" :
                unset($_SESSION['products']);
                $_SESSION["message"] = [
                    "success" => true,
                    "text" => "Tous les produits ont été supprimé avec succès !"
                ];
                header("Location:index.php?route=recap");
                break;

            case "deleteProduct" : 
                $productId = $_GET["id"];
                unset($_SESSION['products'][$productId]);
                $_SESSION["message"] = [
                    "success" => true,
                    "text" => "Le produit a été supprimé avec succès !"
                ];
                header("Location:index.php?route=recap");
                break;

            case "changeQuantity" : 
                $productId = $_GET["id"];
                $operation = $_GET["operation"];
                if($operation == "plus"){
                    $_SESSION['products'][$productId]["quantity"] += 1;
                    $_SESSION['products'][$productId]["total"] =  $_SESSION['products'][$productId]["price"] * $_SESSION['products'][$productId]["quantity"];
                } else if($operation == "minus"){
                    $_SESSION['products'][$productId]["quantity"] -= 1;
                    $_SESSION['products'][$productId]["total"] =  $_SESSION['products'][$productId]["price"] * $_SESSION['products'][$productId]["quantity"];
                    if($_SESSION['products'][$productId]["quantity"] == 0){
                        unset($_SESSION['products'][$productId]);
                    }
                }
                header("Location:index.php?route=recap");
                break;
        }

    } else {
        header("Location:index.php");
    }
?>