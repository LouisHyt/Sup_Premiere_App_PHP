<?php
    ob_start();
    session_start();
    require_once("./utils/functions.php")
?>

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
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
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
                        "<td data-label='Image' data-background=".$product["imagePath"]." style='background-image: url(".$product["imagePath"].")'></td>",
                        "<td data-label='Nom'><a class='openProduct'>".$product['name']."</a></td>",
                        "<td data-label='Description'>".$product['description']."</td>",
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
                        "<td colspan=5> Nombre de produits: ".getProductsCount()." </td>",
                        "<td colspan=2> Total général: <strong>".number_format($totalgeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
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
<!-- Modal -->
<div class="ui modal">
  <i class="close icon"></i>
  <div class="header">
    
  </div>
  <div class="image content">
    <div class="ui medium image">
      <img src="" style="max-width: 300px;">
    </div>
    <div class="description">
      <p></p>
    </div>
  </div>
</div>

<script>
    const openProduct = document.querySelectorAll(".openProduct");
    for(const product of openProduct){
        product.addEventListener("click", e => {
            const parent = e.target.parentNode.parentNode;
            const description = parent.querySelector("td[data-label=Description]").textContent;
            const productName = parent.querySelector("td[data-label=Nom]").textContent;
            const image = parent.querySelector("td[data-label=Image]").getAttribute("data-background");

            //Obligation de l'executer en Jquery (Je n'aime pas le jquery);
            $('.ui.modal').modal('show');

            //On remplace le contenu du modal
            const modal = document.querySelector(".ui.modal");
            modal.querySelector(".header").textContent = productName;
            modal.querySelector(".ui.medium.image > img").src = image;
            modal.querySelector(".description").textContent = description;


        })
    }

</script>

<?php
    $content = ob_get_clean();
    $title = "Récap";
    $currentRoute = "recap";
    require "template.php";
?>
