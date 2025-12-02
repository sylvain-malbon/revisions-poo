<!-- Job 05
Avec votre nouvelle instance de la classe, vous avez récupéré l’id de la category, mais
vous n’avez pas accès à l’entièreté de ses informations (ce qui, il faut se l’avouer, n’est
pas très pratique).
Dans votre classe Product, faites une méthode publique getCategory(). Cette méthode
ne prend aucun paramètre, et devra retourner une instance de la catégorie associée au
produit en utilisant l’id_category en propriété de la classe.
Une fois la méthode fonctionnelle, dans votre fichier index.php, récupérer la catégorie
associée au produit avec l’id 7. -->

<?php
require_once 'category.php';

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

    public function __construct(
        int $id = 0,
        string $name = '',
        array $photos = [],
        int $price = 0,
        string $description = '',
        int $quantity = 0,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
        int $category_id = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
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

    public function getCategory(): ?Category
    {

Avec votre nouvelle instance de la classe, vous avez récupéré l’id de la category, mais
vous n’avez pas accès à l’entièreté de ses informations (ce qui, il faut se l’avouer, n’est
pas très pratique).
Dans votre classe Product, faites une méthode publique getCategory(). Cette méthode
ne prend aucun paramètre, et devra retourner une instance de la catégorie associée au
produit en utilisant l’id_category en propriété de la classe.
Une fois la méthode fonctionnelle, dans votre fichier index.php, récupérer la catégorie
associée au produit avec l’id 7. -->  
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
