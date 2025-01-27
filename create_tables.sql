-- SQL script to create necessary tables for machinery purchasing functionality

-- Create machinery_cart table
CREATE TABLE IF NOT EXISTS machinery_cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    machinery_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (machinery_id) REFERENCES machinery(id) ON DELETE CASCADE
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create order_items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    machinery_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (machinery_id) REFERENCES machinery(id) ON DELETE CASCADE
);
