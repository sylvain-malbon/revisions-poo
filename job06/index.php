<?php
require_once 'Product.php';
require_once 'Category.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=draft_shop;charset=utf8', 'root', '');

// On passe la connexion à Product et Category
Product::setPdo($pdo);
Category::setPdo($pdo);

// On récupère la catégorie du produit avec l'id 7
$product = Product::findOneById(7);

if ($product) {
    $category = $product->getCategory();
    if ($category) {
        $products = $category->getProducts();
        var_dump($products);
    } else {
        echo "Catégorie non trouvée.";
    }
} else {
    echo "Produit non trouvé.";
}
