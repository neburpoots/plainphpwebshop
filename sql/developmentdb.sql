use developmentdb;

CREATE TABLE Products
(
product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
name varchar(50) NOT NULL,
price FLOAT NOT NULL,
stock INT NOT NULL DEFAULT 10,
img varchar(200),
description varchar(200)
);

CREATE TABLE Roles
(
role_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
name varchar(50) NOT NULL
);

CREATE TABLE Users
(
user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
role_id INT NOT NULL,
firstname varchar(50) NOT NULL,
lastname varchar(50) NOT NULL,
email varchar(50) NOT NULL,
username varchar(25) NOT NULL,
password varchar(200) NOT NULL,
FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

CREATE TABLE Orders
(
order_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_id INT NOT NULL,
orderdate DATETIME NOT NULL,
FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Order_Lines
(
order_line_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
order_id INT NOT NULL,
product_id INT NOT NULL,
quantity INT NOT NULL,
FOREIGN KEY (order_id) REFERENCES Orders(order_id),
FOREIGN KEY (product_id) REFERENCES Products(product_id)
);






