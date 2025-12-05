<?php
require_once 'Product.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=draft_shop;charset=utf8', 'root', '');

// On passe la connexion à la classe Product
Product::setPdo($pdo);

// On récupère tous les produits
$products = Product::findAll();

var_dump($products);
