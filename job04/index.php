<?php
require_once 'Product.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=draft_shop;charset=utf8', 'root', '');

// Requête pour récupérer le produit avec l'id 7
$stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
$stmt->execute(['id' => 7]);
$productData = $stmt->fetch(PDO::FETCH_ASSOC);

// Hydratation de l'objet Product
$product = new Product(
    $productData['id'] ?? 0,
    $productData['name'] ?? '',
    isset($productData['photos']) ? explode(',', $productData['photos']) : [],
    $productData['price'] ?? 0,
    $productData['description'] ?? '',
    $productData['quantity'] ?? 0,
    isset($productData['createdAt']) ? new DateTime($productData['createdAt']) : null,
    isset($productData['updatedAt']) ? new DateTime($productData['updatedAt']) : null,
    $productData['category_id'] ?? 0
);

var_dump($product);
