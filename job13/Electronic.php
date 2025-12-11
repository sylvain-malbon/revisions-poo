<?php

require_once 'AbstractProduct.php';


class Electronic extends AbstractProduct
{
    private string $brand;
    private int $waranty_fee;

    public function __construct(
        int $id = 0,
        string $name = '',
        array $photos = [],
        int $price = 0,
        string $description = '',
        int $quantity = 0,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
        int $category_id = 0,
        string $brand = '',
        int $waranty_fee = 0
    ) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id);
        $this->brand = $brand;
        $this->waranty_fee = $waranty_fee;
    }

    // == Méthodes spécifiques pour Electronic == //
    public static function findOneById(int $id)
    {
        if (!static::$pdo) {
            throw new Exception('PDO instance not set.');
        }
        $stmt = static::$pdo->prepare("SELECT * FROM electronic INNER JOIN product ON electronic.product_id = product.id WHERE product.id = :id");
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
                $data['category_id'],
                $data['brand'],
                $data['waranty_fee']
            );
        }
        return false;
    }

    public static function findAll(): array
    {
        if (!static::$pdo) {
            throw new Exception('PDO instance not set.');
        }
        $stmt = static::$pdo->query("SELECT * FROM electronic INNER JOIN product ON electronic.product_id = product.id");
        $electronics = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $electronics[] = new self(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true) ?? [],
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['category_id'],
                $data['brand'],
                $data['waranty_fee']
            );
        }
        return $electronics;
    }

    public function create()
    {
        if (!static::$pdo) {
            throw new Exception('PDO instance not set.');
        }
        // Création dans product
        $stmt = static::$pdo->prepare(
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
            $this->id = (int)static::$pdo->lastInsertId();
            // Création dans electronic
            $stmt2 = static::$pdo->prepare(
                "INSERT INTO electronic (product_id, brand, waranty_fee)
                VALUES (:product_id, :brand, :waranty_fee)"
            );
            $result2 = $stmt2->execute([
                'product_id' => $this->id,
                'brand' => $this->brand,
                'waranty_fee' => $this->waranty_fee
            ]);
            if ($result2) {
                return $this;
            }
        }
        return false;
    }

    public function update()
    {
        if (!static::$pdo) {
            throw new Exception('PDO instance not set.');
        }
        // Update product
        $stmt = static::$pdo->prepare(
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
        // Update electronic
        $stmt2 = static::$pdo->prepare(
            "UPDATE electronic SET brand = :brand, waranty_fee = :waranty_fee WHERE product_id = :product_id"
        );
        $result2 = $stmt2->execute([
            'brand' => $this->brand,
            'waranty_fee' => $this->waranty_fee,
            'product_id' => $this->id
        ]);
        return $result && $result2;
    }

    // == GETTERS & SETTERS == //
    public function getBrand(): string
    {
        return $this->brand;
    }
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getWarantyFee(): int
    {
        return $this->waranty_fee;
    }
    public function setWarantyFee(int $waranty_fee): void
    {
        $this->waranty_fee = $waranty_fee;
    }
}
