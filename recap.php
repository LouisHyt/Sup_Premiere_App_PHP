<div class="products">
    <?php
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p class='emptyInfo'>Aucun produit n'est enregistré en session...</p>";
    } else {
    ?>
    <table class="ui celled table products-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $totalgeneral = 0;
                foreach ($_SESSION["products"] as $index => $product) {
                    echo "<tr>",
                        "<td data-label='#'>".$index."</td>",
                        "<td data-label='Nom'>".$product['name']."</td>",
                        "<td data-label='Prix'>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td data-label='Quantité' class='rowQuantity'>
                            <a href='traitement.php?action=changeQuantity&id=$index&operation=minus'>
                                <button class='ui icon button'>
                                    <i class='minus icon'></i>
                                </button>
                            </a>
                            <span>".$product['quantity']."</span>
                            <a href='traitement.php?action=changeQuantity&id=$index&operation=plus'>
                                <button class='ui icon button'>
                                    <i class='plus icon'></i>
                                </button>
                            </a>
                        </td>",
                        "<td data-label='total'>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td data-label='action'>
                            <a href='traitement.php?action=deleteProduct&id=$index'>
                                <button class='ui icon button delete-product' title='Supprimer le produit'>
                                    <i class='trash alternate icon'></i>
                                </button>
                            </a>
                        </td>",
                    "</tr>";
                    $totalgeneral += $product['total'];
                } 
                echo "<tr class='last-row'>",
                        "<td colspan=4> Nombre de produits: ".count($_SESSION["products"])." </td>",
                        "<td> Total général: <strong>".number_format($totalgeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                        "<td>
                            <a href='traitement.php?action=deleteAllProduct'>
                                <button class='ui icon button delete-allproducts' title='Supprimer tous les produits'>
                                    <i class='undo alternate icon'></i>
                                </button>
                            </a>
                        </td>",
                    "<tr>"
                        
            ?>
        </tbody>
    </table>
    <?php } ?>
</div>
