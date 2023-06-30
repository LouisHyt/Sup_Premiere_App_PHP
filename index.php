<?php
    ob_start();
?>

<h1>Ajouter un produit</h1>
<form class="ui form" action="traitement.php?action=addProduct" method="post">
    <div class="field">
        <label>Nom du Produit</label>
        <input type="text" name="name" placeholder="Nom du Produit">
    </div>
    <div class="field">
        <label>Prix</label>
        <input type="number" name="price" step="1" placeholder="Prix">
    </div>
    <div class="field">
        <label>Quantité</label>
    <input type="number" name="quantity" value="1">
    </div>
    
    <button type="submit" class="ui animated button">
        <div class="visible content">Ajouter</div>
        <div class="hidden content">
            <i class="shop icon"></i>
        </div>
    </button>
</form>

<?php
    $content = ob_get_clean();
    $title = "Ajout des produits";
    $currentRoute = "default";
    require "template.php";
?>