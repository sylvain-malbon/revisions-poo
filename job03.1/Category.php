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

class Category
{
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(
        int $id = 0,
        string $name = '',
        string $description = '',
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
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

    public function getDescription(): string
    {
        return $this->description;
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

    public function setDescription(string $description): void
    {
        $this->description = $description;
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
