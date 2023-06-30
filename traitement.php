<?php
    session_start();
    require_once("./utils/functions.php");
    if(isset($_GET['action'])){

        switch($_GET['action']){
            case "addProduct" :
                if(!isset($_POST) || empty($_POST)){
                    $_SESSION["message"] = [
                        "success" => false,
                        "text" => "Vous n'avez pas accès à cette page ! Merci de passer par le formulaire pour ajouter un produit"
                    ];
                } else {
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT);
                    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
                    $imageName = $_FILES['image']["name"];
                    $allowedImages = ["jpg", "jpeg", "png"];

                    if($name && $price && $quantity && $description && !empty($imageName)){
                        $imageTemp = $_FILES['image']["tmp_name"];
                        $imageSize = $_FILES['image']["size"];
                        $imageError = $_FILES['image']["error"];
                        $imageTabExension = explode('.', $imageName);
                        $imageExtension = strtolower(end($imageTabExension));
                        $imageUniqueName = uniqid('', true).".".$imageExtension;
                        $maxImageSize = 5242880; // 5Mb

                        if(in_array($imageExtension, $allowedImages) && $imageSize <= $maxImageSize && $imageError == 0){
                            move_uploaded_file($imageTemp, "./uploads/$imageUniqueName");
                            $product = [
                                "name" => $name,
                                "price" => $price,
                                "quantity" => $quantity,
                                'total' => $price * $quantity,
                                "description" => $description,
                                "imagePath" => "./uploads/$imageUniqueName"
                            ];
    
                            $_SESSION['products'][] = $product;
                            $_SESSION["message"] = [
                                "success" => true,
                                "text" => "Le produit a été ajouté avec succès !"
                            ];
                        } else {
                            if($imageError !== 0){
                                $_SESSION["message"] = [
                                    "success" => false,
                                    "text" => "Une erreur avec l'image est survenue..."
                                ];
                            } else {
                                $_SESSION["message"] = [
                                    "success" => false,
                                    "text" => "Le format de l'image n'est pas accepté ou sa taille est trop grande ! Formats acceptés: ". implode(", ", $allowedImages)
                                ];
                            }
                        }
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
                deleteAllProduct($_SESSION['products']);
                unset($_SESSION['products']);
                $_SESSION["message"] = [
                    "success" => true,
                    "text" => "Tous les produits ont été supprimé avec succès !"
                ];
                header("Location:recap.php");
                break;

            case "deleteProduct" : 
                $productId = $_GET["id"];
                deleteProduct($_SESSION['products'][$productId]);
                unset($_SESSION['products'][$productId]);
                $_SESSION["message"] = [
                    "success" => true,
                    "text" => "Le produit a été supprimé avec succès !"
                ];
                header("Location:recap.php");
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
                        deleteProduct($_SESSION['products'][$productId]);
                        unset($_SESSION['products'][$productId]);
                    }
                }
                header("Location:recap.php");
                break;
        }

    } else {
        header("Location:index.php");
    }
?>