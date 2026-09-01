# 🏦 Koperasi ABATASA

Aplikasi **Manajemen Koperasi berbasis web** yang dikembangkan untuk membantu proses pengelolaan data anggota, iuran, angsuran, pembayaran, pendapatan, dan usaha koperasi secara lebih terstruktur.

## 📌 About The Project

**Koperasi ABATASA** merupakan aplikasi berbasis web yang dirancang untuk mendukung pengelolaan administrasi koperasi.

Aplikasi ini membantu pengelola dalam melakukan pencatatan dan pemantauan transaksi koperasi melalui dashboard dan beberapa modul pengelolaan data.

## ✨ Features

* 👥 **Data Anggota**

  * Menambah data anggota
  * Mengubah data anggota
  * Menghapus data anggota
  * Melihat detail anggota

* 💰 **Data Iuran**

  * Pencatatan iuran anggota
  * Pengelolaan data pembayaran iuran
  * Monitoring pembayaran

* 📋 **Data Angsuran**

  * Pencatatan angsuran anggota
  * Pembayaran angsuran
  * Perhitungan jumlah terbayar
  * Perhitungan sisa angsuran
  * Status pembayaran

* 💵 **Pendapatan**

  * Pencatatan pendapatan koperasi
  * Monitoring transaksi pendapatan

* 🏪 **Data Usaha**

  * Pengelolaan data usaha koperasi
  * Pencatatan aktivitas usaha

* 📊 **Dashboard**

  * Ringkasan data koperasi
  * Total anggota
  * Total iuran
  * Total angsuran
  * Total pendapatan

## 🛠️ Tech Stack

### Frontend

* HTML
* CSS
* JavaScript
* Bootstrap 5
* Sneat Admin Template

### Backend

* PHP
* CodeIgniter 4

### Database

* MySQL

### Tools

* Visual Studio Code
* XAMPP
* Git & GitHub

## 🗂️ Project Structure

```text
ci-kop-risalah/
├── app/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
│
├── public/
│   ├── assets/
│   └── ...
│
├── writable/
├── system/
├── .env
└── README.md
```

## 🗄️ Database

Aplikasi menggunakan **MySQL** sebagai database.

Database utama:

```text
koperasi
```

Beberapa tabel yang digunakan:

```text
anggota
data_iuran
data_angsuran
data_pendapatan
data_usaha
pembayaran_angsuran
```

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/fandydahlan3/my-portfolio.git
```

### 2. Masuk ke Folder Project

```bash
cd my-portfolio/ci-kop-risalah
```

### 3. Install Dependency

```bash
composer install
```

### 4. Konfigurasi Environment

Copy file:

```text
env
```

menjadi:

```text
.env
```

Kemudian sesuaikan konfigurasi database:

```env
database.default.hostname = 127.0.0.1
database.default.database = koperasi
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 5. Import Database

Buat database:

```text
koperasi
```

Kemudian import file database melalui **phpMyAdmin**.

### 6. Jalankan Aplikasi

```bash
php spark serve
```

Kemudian buka:

```text
http://localhost:8080
```

## 📸 Screenshots

### Dashboard

Tambahkan screenshot dashboard di sini:

```markdown
![Dashboard](public/images/dashboard.png)
```

### Data Anggota

```markdown
![Data Anggota](public/images/data-anggota.png)
```

### Data Angsuran

```markdown
![Data Angsuran](public/images/data-angsuran.png)
```

## 🎯 Project Purpose

Project ini dibuat sebagai implementasi pengembangan aplikasi **web-based cooperative management system** dengan menggunakan **CodeIgniter 4 dan MySQL**.

Project juga menjadi bagian dari portfolio untuk menunjukkan kemampuan dalam:

* Web Development
* Backend Development
* Database Management
* CRUD Application
* System Analysis
* UI Implementation
* Business Process Implementation

## 👨‍💻 Developer

**Fandy Bonaro Dahlan**

Information Systems Graduate

Interested in:

`Business Analyst` · `Web Development` · `Frontend` · `Backend` · `UI/UX` · `IT Support`

---

⭐ If you find this project useful, feel free to give it a star!
