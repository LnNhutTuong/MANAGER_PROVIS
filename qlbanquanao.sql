DROP DATABASE IF EXISTS MANAGER_PROVIS;
CREATE DATABASE MANAGER_PROVIS CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE MANAGER_PROVIS;

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    username VARCHAR(200) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(200) NOT NULL,
    address TEXT,
    forget_token VARCHAR(500),
    active_token VARCHAR(500),
    groupid INT,
    created_at DATETIME,
    update_at DATETIME
);

CREATE TABLE Token_login (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    user_id INT NOT NULL,
    token VARCHAR(200) NOT NULL,
    created_at DATETIME,
    update_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES Users(id)
        ON UPDATE CASCADE
);

CREATE TABLE Brand (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) UNIQUE NOT NULL,
    created_at DATETIME,
    update_at DATETIME
);
CREATE TABLE Categroy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    created_at DATETIME,
    update_at DATETIME
);

CREATE TABLE Style (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(200) NOT NULL,
    created_at DATETIME,
    update_at DATETIME
);

CREATE TABLE Products (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price INT,
    thumb VARCHAR(200),
    category_id INT,
    brand_id INT,
    size VARCHAR(200),
    color VARCHAR(100),
    created_at DATETIME,
    update_at DATETIME,
    FOREIGN KEY (category_id) REFERENCES Categroy(id)
        ON DELETE RESTRICT,
    FOREIGN KEY (brand_id) REFERENCES Brand(id)
        ON DELETE RESTRICT
);



CREATE TABLE Product_image(
    id INT AUTO_INCREMENT PRIMARY KEY ,
    product_id INT NOT NULL,
    img_back VARCHAR(300),
    img_left VARCHAR(300),
    img_right VARCHAR(300),
    img_zoom VARCHAR(300), 
    created_at DATETIME,
    update_at DATETIME,
    FOREIGN KEY (product_id) REFERENCES Products(id)
        ON DELETE RESTRICT
);

CREATE TABLE Product_style(
    id INT AUTO_INCREMENT PRIMARY KEY ,
    style_id INT NOT NULL,
    product_id INT NOT NULL,
    FOREIGN KEY (style_id) REFERENCES Style(id)
        ON DELETE RESTRICT,
    FOREIGN KEY (product_id) REFERENCES Products(id)
        ON DELETE RESTRICT
);