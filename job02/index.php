<?php
require_once 'Product.php';
require_once 'Category.php';

$product = new Product(
    1,
    'T-shirt',
    ['https://picsum.photos/200/300'],
    1000,
    'A beautiful T-shirt',
    10,
    new DateTime(),
    new DateTime(),
    1
);

var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getPhotos());
var_dump($product->getPrice());
var_dump($product->getDescription());
var_dump($product->getQuantity());
var_dump($product->getCreatedAt());
var_dump($product->getUpdatedAt());
var_dump($product->getCategory_id());

$product->setId(2);
$product->setName('Sweat-shirt');
$product->setPhotos(['https://picsum.photos/200/300']);
$product->setPrice(2000);
$product->setDescription('A beautiful sweat-shirt');
$product->setQuantity(20);
$product->setCreatedAt(new DateTime('2023-12-01'));
$product->setUpdatedAt(new DateTime('2023-12-02'));
$product->setCategory_id(2);
