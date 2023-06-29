<?php
    session_start()
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recapitulatif des produits</title>
</head>
<body>
    <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit n'est enregistré en session...</p>";
        } else {
        ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalgeneral = 0;
                    foreach ($_SESSION["products"] as $index => $product) {
                        echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",
                            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "<td>".$product['quantity']."</td>",
                            "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "</tr>";
                        $totalgeneral += $product['total'];
                    } 
                    echo "<tr>",
                            "<td colspan=4>Total général: </td>",
                            "<td><strong>".number_format($totalgeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                         "<tr>"
                    
                    ?>
                </tbody>
            </table>
         <?php } ?>
</body>
</html>