## Point of Sale
Aplikasi POS berbasis Website untuk memudahkan mengelola produk yang dijual.
cocok untuk usaha / organisasi kecil dan menengah.

<!-- - referensi   : http://app.dndsoft.my.id/dndpos/products
- tokped      : https://www.tokopedia.com/dndsoft/source-code-point-of-sale-program-kasir-berbasis-codeiginiter?extParam=ivf%3Dfalse&refined=true -->

## Kasiran Setup

```bash
# install dependencies
$ composer install

# for create database
$ php kasiran --setup-db
$ 1 ( untuk membuat database jika tidak ada )

# With create table
$ php kasiran --setup-tb
$ 1 ( Membuat semua tabel yang dibutuhkan aplikasi )
$ 2 ( Menambahkan 1 data admin pada database )

# serve with hot reload at http://127.0.0.1:3000/
$ php kasiran serve
```


## Role 
- Admin
  - email     : admin@gmail.com
  - password  : admin
- Kasir
  - email     : kasir@gmail.com
  - password  : kasir

## Fitur dari aplikasi
beberapa fitur dari aplikasi Kasiran

**Login**
 - Login sebagai Admin
 - Login sebagai Kasir

**Aplikasi**
- Custom Color (Mengatur warna website sesuai keinginan)
- Theme (Memilih langsung tema yang sudah disediakan)
  - Dark 
  - Pink
  - Tea
- Tambah Produk
- Hapus Produk
- Export produk ke excel
- Backup Produk
- Memenej Laporan produk bertambah setiap bulan
- Memenej semua stock yang telah ditambahkan / bulan
- Mengontrol aktifitas admin dan kasir
- Reset data aplikasi
- Memulihkan data yang telah di backup

- Admin 
  - Edit nama
  - Edit Email
  - Edit avatar
  - Edit Password
- Kasir
  - Edit nama
  - Edit Email
  - Edit avatar