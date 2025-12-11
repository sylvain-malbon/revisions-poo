<!-- Job 12
Vous savez maintenant faire de l’héritage entre vos différentes classes. Il pourrait être
intéressant de faire en sorte de changer le comportement de certaines méthodes de
nos classes enfants. En effet, si l’on veut que nos méthodes findOneById, findAll, et
create, update fonctionnent à nouveau, il va falloir les réécrire dans nos classes
enfants Clothing et Electronic.
Par exemple, dans la classe Clothing, la méthode findOneById doit donc renvoyer une
instance de la classe Clothing ou false, la méthode findAll doit donc renvoyer un
tableau d’instance de la classe Clothing, etc. -->

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
