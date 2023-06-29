<?php
    session_start();
    if(isset($_POST["submit"])){

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
        }
    }

    header("Location:index.php");
?>