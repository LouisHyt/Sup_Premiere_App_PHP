<?php


    function getProductsCount(){
        $totalCount = 0;
        if(isset($_SESSION['products']) || !empty($_SESSION['products'])){
            foreach ($_SESSION['products'] as $product) {
                $totalCount += $product["quantity"];
            }
        }
        return $totalCount;
    }

    function deleteProduct($product){
        unlink($product["imagePath"]);
    }

    function deleteAllProduct($products){
        foreach ($products as $product) {
            unlink($product["imagePath"]);
        }
    }

?>