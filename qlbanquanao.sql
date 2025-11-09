DROP DATABASE IF EXISTS MANAGER_PROVIS;
CREATE DATABASE MANAGER_PROVIS CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE MANAGER_PROVIS;

CREATE TABLE UserGroups (

CREATE TABLE Groups (
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(200) NOT NULL,
    created_at DATETIME,
    update_at DATETIME
);

CREATE TABLE Users (
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    username VARCHAR(200),
    password VARCHAR(200),
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(11),
    address TEXT,
    forget_token VARCHAR(500),
    active_token VARCHAR(500),
    group_id INT,
    created_at DATETIME,
    update_at DATETIME,
    FOREIGN KEY (group_id) REFERENCES Groups(ID)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE Token_login (
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    user_id INT NOT NULL,
    token VARCHAR(200) NOT NULL,
    created_at DATETIME,
    update_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES Users(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Brand (
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(200) UNIQUE NOT NULL,
    created_at DATETIME,
    update_at DATETIME
);

CREATE TABLE Category (
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(200) UNIQUE NOT NULL,
    created_at DATETIME,
    update_at DATETIME
);

CREATE TABLE Style (
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(200) UNIQUE NOT NULL,
    created_at DATETIME,
    update_at DATETIME
);
CREATE TABLE Products (
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(200) NOT NULL,
    brand_id INT,
    size VARCHAR(10),
    color VARCHAR(100),
    descreption TEXT,
    price INT,
    thumb VARCHAR(200),
    created_at DATETIME,
    update_at DATETIME,
    FOREIGN KEY (brand_id) REFERENCES Brand(ID)
        ON DELETE SET NULL 
        ON UPDATE CASCADE
    );