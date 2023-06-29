<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouts produit</title>
</head>
<body>
    <h1>Ajouter un produit</h1>
    <form action="traitement.php" method="post">
        <p>
            <label>
                Nom du produit
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée
                <input type="number" value="1" name="quantity">
            </label>
        </p>
        <p>
            <input type="submit" value="Ajouter le produit" name="submit">
        </p>
    </form>
</body>
</html>