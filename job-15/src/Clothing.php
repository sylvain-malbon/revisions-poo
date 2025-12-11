<?php

namespace App;

use App\Abstract\AbstractProduct;
use App\Interface\StockableInterface;

class Clothing extends AbstractProduct implements StockableInterface
{
    private string $size;
    private string $color;
    private string $type;
    private int $material_fee;

    public function __construct(
        int $id = 0,
        string $name = '',
        array $photos = [],
        int $price = 0,
        string $description = '',
        int $quantity = 0,
        ?\DateTime $createdAt = null,
        ?\DateTime $updatedAt = null,
        int $category_id = 0,
        string $size = '',
        string $color = '',
        string $type = '',
        int $material_fee = 0
    ) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id);
        $this->size = $size;
        $this->color = $color;
        $this->type = $type;
        $this->material_fee = $material_fee;
    }

    // == Gestion des stocks == //
    public function addStocks(int $stock): self
    {
        $this->quantity += $stock;
        return $this;
    }

    public function removeStocks(int $stock): self
    {
        $this->quantity = max(0, $this->quantity - $stock);
        return $this;
    }

    // == Méthodes spécifiques pour Clothing == //
    public static function findOneById(int $id)
    {
        if (!static::$pdo) {
            throw new \Exception('PDO instance not set.');
        }
        $stmt = static::$pdo->prepare("SELECT * FROM clothing INNER JOIN product ON clothing.product_id = product.id WHERE product.id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            return new self(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true) ?? [],
                $data['price'],
                $data['description'],
                $data['quantity'],
                new \DateTime($data['createdAt']),
                new \DateTime($data['updatedAt']),
                $data['category_id'],
                $data['size'],
                $data['color'],
                $data['type'],
                $data['material_fee']
            );
        }
        return false;
    }

    public static function findAll(): array
    {
        if (!static::$pdo) {
            throw new \Exception('PDO instance not set.');
        }
        $stmt = static::$pdo->query("SELECT * FROM clothing INNER JOIN product ON clothing.product_id = product.id");
        $clothes = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $clothes[] = new self(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true) ?? [],
                $data['price'],
                $data['description'],
                $data['quantity'],
                new \DateTime($data['createdAt']),
                new \DateTime($data['updatedAt']),
                $data['category_id'],
                $data['size'],
                $data['color'],
                $data['type'],
                $data['material_fee']
            );
        }
        return $clothes;
    }

    public function create()
    {
        if (!static::$pdo) {
            throw new \Exception('PDO instance not set.');
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
            // Création dans clothing
            $stmt2 = static::$pdo->prepare(
                "INSERT INTO clothing (product_id, size, color, type, material_fee)
				VALUES (:product_id, :size, :color, :type, :material_fee)"
            );
            $result2 = $stmt2->execute([
                'product_id' => $this->id,
                'size' => $this->size,
                'color' => $this->color,
                'type' => $this->type,
                'material_fee' => $this->material_fee
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
            throw new \Exception('PDO instance not set.');
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
        // Update clothing
        $stmt2 = static::$pdo->prepare(
            "UPDATE clothing SET size = :size, color = :color, type = :type, material_fee = :material_fee WHERE product_id = :product_id"
        );
        $result2 = $stmt2->execute([
            'size' => $this->size,
            'color' => $this->color,
            'type' => $this->type,
            'material_fee' => $this->material_fee,
            'product_id' => $this->id
        ]);
        return $result && $result2;
    }

    // == GETTERS & SETTERS == //
    public function getSize(): string
    {
        return $this->size;
    }
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    public function getColor(): string
    {
        return $this->color;
    }
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getMaterialFee(): int
    {
        return $this->material_fee;
    }
    public function setMaterialFee(int $material_fee): void
    {
        $this->material_fee = $material_fee;
    }
}
