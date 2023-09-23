CREATE DATABASE admin_users CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use admin_users;

CREATE TABLE users(
id              INT(11) NOT NULL AUTO_INCREMENT,
user_name       VARCHAR(255) NOT NULL,
email           VARCHAR(255) NOT NULL,
image           VARCHAR(255),
capabilities    VARCHAR(50) NOT NULL DEFAULT 'subscriber',
password        VARCHAR(255) NOT NULL,
created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
CONSTRAINT PK_users PRIMARY KEY (id)
)ENGINE=InnoDb;

INSERT INTO users (user_name,email,capabilities,password) VALUES('admin','admin@admin.com','admin','$2y$04$Z5iSIQWXEzguqPILvi6VN.02lgSWi0i0FmLQrG2/lkX3zQ.bB7d7e');