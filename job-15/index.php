<?php
// Job 15 : Point d'entrée, autoload via Composer
require_once __DIR__ . '/vendor/autoload.php';

use App\Clothing;
use App\Electronic;

// Exemple d'utilisation (à adapter selon ta logique)
$pdo = new PDO('mysql:host=localhost;dbname=draft_shop;charset=utf8', 'root', '');
Clothing::setPdo($pdo);
Electronic::setPdo($pdo);

$clothes = Clothing::findAll();
$electronics = Electronic::findAll();

var_dump($clothes);
var_dump($electronics);
