<?php 
/* ----------------------
 * | tabel user         |
 * ---------------------- 
 * menambah tabel user
 */
$tabel_user = "CREATE TABLE IF NOT EXISTS user (
    id INT(11) NOT NULL AUTO_INCREMENT,
    image TEXT NOT NULL,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    no_tlp VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Kasir', 'Supplier') NOT NULL,
    alamat VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";

/* ----------------------
 * | tabel backup_log   |
 * ---------------------- 
 * menambah tabel backup_log
 */
$tabel_backup_log = "CREATE TABLE IF NOT EXISTS backup_log (
    id INT(11) NOT NULL AUTO_INCREMENT,
    tabel_name VARCHAR(255) NOT NULL,
    filename VARCHAR(255) NOT NULL,
    backup_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";

/* ----------------------
 * | tabel produk       |
 * ---------------------- 
 * menambah tabel produk
 */
$tabel_produk = "CREATE TABLE IF NOT EXISTS product (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  image TEXT NOT NULL,
  type VARCHAR(255) NOT NULL,
  category VARCHAR(255) NOT NULL,
  quantity INT(255) NOT NULL,
  first_quantity INT(255) NOT NULL,
  tax INT(11) NOT NULL,
  cost INT(255) NOT NULL,
  price INT(255) NOT NULL,
  discount INT(11),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)";

/* ----------------------
 * | tabel user_log     |
 * ---------------------- 
 * menambah tabel user_log
 */
$tabel_user_log = "CREATE TABLE IF NOT EXISTS user_log (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    action VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id)
)";


/* ----------------------
 * | tabel action_log   |
 * ---------------------- 
 * menambah tabel action_log
 */
$action_log = "CREATE TABLE IF NOT EXISTS action_log (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    user VARCHAR(255) NOT NULL,
    action VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id)
)";


/* ----------------------
 * | tabel transaksi   |
 * ---------------------- 
 * menambah tabel transaksi
 */
$tabel_transaksi = "CREATE TABLE IF NOT EXISTS transaksi (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    nama_user VARCHAR(255) NOT NULL,
    barang_id INT(11) NOT NULL,
    jumlah_beli INT(11) NOT NULL,
    total_price INT(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (barang_id) REFERENCES product(id)
)";


/* ----------------------
 * | tabel kategory     |
 * ---------------------- 
 * menambah tabel kategory  
 */
$tabel_kategory = "CREATE TABLE IF NOT EXISTS kategory (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";


/* ----------------------
 * | tabel type         |
 * ---------------------- 
 * menambah tabel type  
 */
$tabel_type = "CREATE TABLE IF NOT EXISTS type (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";
