USE draft_shop;

DROP TABLE IF EXISTS electronic;
DROP TABLE IF EXISTS product;

CREATE TABLE product (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    photos TEXT,
    price INT,
    description TEXT,
    quantity INT,
    createdAt DATETIME,
    updatedAt DATETIME,
    category_id INT
) ENGINE=InnoDB;

CREATE TABLE electronic (
    product_id INT PRIMARY KEY,
    brand VARCHAR(255),
    waranty_fee INT,
    FOREIGN KEY (product_id) REFERENCES product(id)
) ENGINE=InnoDB;