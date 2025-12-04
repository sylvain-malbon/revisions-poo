<?php

class Category
{
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    private static ?\PDO $pdo = null;

    public static function setPdo(\PDO $pdo): void
    {
        self::$pdo = $pdo;
    }

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

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function getProducts(): array
    {
        if (!self::$pdo) {
            throw new Exception('PDO instance not set.');
        }
        $stmt = self::$pdo->prepare("SELECT * FROM product WHERE category_id = :category_id");
        $stmt->execute(['category_id' => $this->getId()]);
        $products = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true) ?? [],
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['category_id']
            );
        }
        return $products;
    }
}
