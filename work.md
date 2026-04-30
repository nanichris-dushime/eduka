#task:
Implemented features (files added/updated):

- Session-based login/logout: `login.php`, `logout.php`
- Signup (passwords hashed): `signup.php`, `tableconn.php`
- Product CRUD: `products.php`, `product_create.php`, `product_edit.php`, `product_delete.php`
- PDO DB helper: `db.php` (use this for DB connection)
- Backwards compatibility: `conn.php` was removed in favor of `db.php` (older code can include `db.php`)

Database (MySQL) expected:
- Database name: `eduka` (create if missing)
- Tables:
    - `users` (uid [PK AUTO_INCREMENT], username, password, type, name)
    - `product` (pid [PK AUTO_INCREMENT], pname, uprice, nproduct)

Quick setup:
1. Create database and tables (example SQL):

```sql
CREATE DATABASE IF NOT EXISTS eduka DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE eduka;

CREATE TABLE IF NOT EXISTS users (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    type VARCHAR(50) DEFAULT 'cashier',
    name VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS product (
    pid INT AUTO_INCREMENT PRIMARY KEY,
    pname VARCHAR(255) NOT NULL,
    uprice DECIMAL(10,2) DEFAULT 0.00,
    nproduct INT DEFAULT 0
);
```markdown
#task:
a program that allow user to login ( session based)
signup ( encrypted)
CRUD:(register product,view products , modify product , delete product)
kinyirwanda(frontend)
db_name:iduka
tables:[users:{
uid,username,password,type,name
},
product:{
    pid,pname,uprice,nproduct
}
]
db connection (PDO)
```
