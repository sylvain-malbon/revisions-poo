<!-- Job 02
Évidemment, dans une boutique en ligne, nous n’avons pas que des produits. Il y a aussi
des catégories auxquels sont associés ces produits.
Créez une classe Category, avec les propriétés privées suivantes et les getters et
setters associés :
- id : un entier naturel
- name : une chaine de caractère
- description : une chaine de caractère
- createdAt : une instance d’un objet DateTime
- updatedAt : une instance d’un objet DateTime
Ajoutez maintenant dans votre class Product un champ category_id, permettant de
stocker un id de la classe Category, avec les setters et getters associés. Comme pour
les produits, les propriétés des catégories doivent pouvoir être initialisées via le
constructeur à l’instanciation de la classe. -->

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
    private $category_id;

    public function __construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->category_id = $category_id;
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

    public function getCategory_id(): int
    {
        return $this->category_id;
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

    public function setCategory_id(int $category_id): void
    {
        $this->category_id = $category_id;
    }
}
