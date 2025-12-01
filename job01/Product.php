<!-- Job 01

Nous allons prendre un exemple réaliste afin de coller au mieux à ce que vous pourriez
rencontrer dans une application. Pour cela, nous allons commencer par créer une
classe Product, permettant de représenter par exemple un produit dans une boutique.
Cette classe aura les propriétés privées suivantes :
- id : un entier naturel
- name : une chaîne de caractères
- photos : un tableau de chaînes de caractères
- price : un entier naturel
- description : une chaîne de caractères
- quantity : un entier naturel
- createdAt : une instance d’un objet DateTime
- updatedAt : une instance d’un objet DateTime
Créez ensuite les getters et les setters associés à cette classe. Pour rappel, les getters
d’une classe permettent d’accéder à des propriétés privées en dehors de la classe et les
setters permettent de modifier les valeurs de ces propriétés.
Faites en sorte d’initialiser les propriétés de votre classe avec le constructeur de
celle-ci. Par exemple :

Une fois votre classe instanciée, vous pouvez récupérer les propriétés grâce à vos
getters, vérifier leurs valeurs, et les modifier avec vos setters. Utiliser la fonction
var_dump() pour faire vos tests, par exemple dans un fichier index.php.-->

<?php

class Product
{
    private int $id;
    private string $name;
    private array $photos;
    private int $price;
    private string $description;
    private int $quantity;
    // important ci-dessous  
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // == GETTERS == //
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    // == SETTERS == //
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
