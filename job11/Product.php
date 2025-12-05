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

    private static ?\PDO $pdo = null;

    public static function setPdo(\PDO $pdo): void
    {
        self::$pdo = $pdo;
    }

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
        $stmt = $this->pdo->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->execute(['id' => $this->category_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Category(
                $data['id'],
                $data['name'],
                $data['description'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt'])
            );
        }
        return null;
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

    // méthode publique findOneById(int $id)

    public static function findOneById(int $id)
    {
        if (!self::$pdo) {
            throw new Exception('PDO instance not set.');
        }

        $stmt = self::$pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new self(
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
        return false;
    }

    public static function findAll(): array
    {
        if (!self::$pdo) {
            throw new Exception('PDO instance not set.');
        }

        $stmt = self::$pdo->query("SELECT * FROM product");
        $products = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new self(
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

    public function create()
    {
        if (!self::$pdo) {
            throw new Exception('PDO instance not set.');
        }

        $stmt = self::$pdo->prepare(
            "INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id)
            VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)"
        );

        $result = $stmt->execute([
            'name' => $this->name,
            'photos' => json_encode($this->photos),
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id
        ]);

        if ($result) {
            $this->id = (int)self::$pdo->lastInsertId();
            return $this;
        }
        return false;
    }

    public function update()
    {
        if (!self::$pdo) {
            throw new Exception('PDO instance not set.');
        }

        $stmt = self::$pdo->prepare(
            "UPDATE product SET 
                name = :name,
                photos = :photos,
                price = :price,
                description = :description,
                quantity = :quantity,
                createdAt = :createdAt,
                updatedAt = :updatedAt,
                category_id = :category_id
            WHERE id = :id"
        );

        $result = $stmt->execute([
            'name' => $this->name,
            'photos' => json_encode($this->photos),
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id,
            'id' => $this->id
        ]);

        return $result;
    }
}
