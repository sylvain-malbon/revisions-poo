<?php

require_once 'Product.php';

class Electronic extends Product
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
