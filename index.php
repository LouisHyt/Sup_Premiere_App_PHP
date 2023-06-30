<?php
    ob_start();
    session_start();
?>

<h1>Ajouter un produit</h1>
<form class="ui form" action="traitement.php?action=addProduct" method="post" enctype="multipart/form-data">
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
    <div class="field">
        <label>Description</label>
        <textarea name="description"></textarea>
    </div>
    <div class="field">
        <label>Image</label>
        <input type="file" name="image" accept="image/png, image.jpg, image.jpeg">
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