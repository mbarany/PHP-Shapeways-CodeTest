-- SQLite compatible
CREATE TABLE users
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    first_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NULL
);
CREATE TABLE products
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100) NOT NULL
);
CREATE TABLE comments
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    product_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    comment VARCHAR(255),
    created_at DATETIME NOT NULL,
    FOREIGN KEY(product_id) REFERENCES products(id),
    FOREIGN KEY(user_id) REFERENCES users(id)
);
CREATE TABLE product_users
(
    product_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    last_comment_id INTEGER NOT NULL,
    PRIMARY KEY (product_id, user_id),
    FOREIGN KEY(product_id) REFERENCES products(id),
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(last_comment_id) REFERENCES comments(id)
);
