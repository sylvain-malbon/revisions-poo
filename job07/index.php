<?php
require_once 'Product.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=draft_shop;charset=utf8', 'root', '');

// On passe la connexion à la classe Product
Product::setPdo($pdo);

// On récupère le produit avec l'id
$id = $_GET['id'] ?? 1; // récupère l'id depuis l'URL ou prend 1 par défaut
$product = Product::findOneById($id);

if ($product) {
    var_dump($product);
    $category = $product->getCategory();
    var_dump($category);
} else {
    echo "Produit non trouvé.";
}
