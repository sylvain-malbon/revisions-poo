<!-- Job 14
Vous avez deux classes qui vous permettent de représenter des produits dans votre
application. Il vous manque en revanche un moyen de gérer les stocks de chacun de vos
articles.
Créez une SockableInterface avec les méthodes addStocks(int $stock): self et
removeStocks(int $stock): self. Implémentez ensuite cette interface dans vos classes
Clothing et Electronic. -->

<?php
require_once 'AbstractProduct.php';
require_once 'Clothing.php';
require_once 'Electronic.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=draft_shop;charset=utf8', 'root', '');

// On passe la connexion à toutes les classes
Product::setPdo($pdo);
Clothing::setPdo($pdo);
Electronic::setPdo($pdo);

echo "<h2>Test Clothing::findAll()</h2>";
$clothes = Clothing::findAll();
var_dump($clothes);

echo "<h2>Test Clothing::findOneById(1)</h2>";
$clothing = Clothing::findOneById(1);
var_dump($clothing);

echo "<h2>Test Electronic::findAll()</h2>";
$electronics = Electronic::findAll();
var_dump($electronics);

echo "<h2>Test Electronic::findOneById(1)</h2>";
$electronic = Electronic::findOneById(1);
var_dump($electronic);

// Exemple de création d'un nouveau vêtement
/*
$newClothing = new Clothing(
	0,
	'T-shirt',
	['tshirt.jpg'],
	20,
	'Un t-shirt confortable',
	100,
	new DateTime(),
	new DateTime(),
	1, // category_id
	'L',
	'Bleu',
	'T-shirt',
	2
);
$newClothing->create();
var_dump($newClothing);
*/

// Exemple de mise à jour d'un vêtement existant
/*
if ($clothing) {
	$clothing->setColor('Rouge');
	$clothing->update();
	var_dump($clothing);
}
*/
