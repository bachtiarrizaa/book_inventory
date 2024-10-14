# Book Inventory API

## A. Penjelasan Project

Book Inventory API adalah sebuah aplikasi backend yang dibangun menggunakan Laravel 8. Aplikasi ini berfungsi untuk mengelola data buku dan penulis (authors) dengan relasi One-to-Many, di mana satu penulis dapat memiliki banyak buku. API ini juga mendukung operasi CRUD (Create, Read, Update, Delete) untuk data buku dan penulis, serta fitur pencarian berdasarkan judul buku. Sistem autentikasi untuk admin menggunakan Laravel Sanctum untuk memastikan hanya admin yang dapat melakukan manajemen data melalui API.

### Fitur Utama:

-   CRUD untuk data buku dan penulis
-   Autentikasi admin menggunakan Laravel Sanctum
-   Pencarian buku berdasarkan judul
-   Relasi One-to-Many antara penulis dan buku
-   Respon dalam bentuk JSON
-   Middleware untuk membatasi akses hanya bagi admin

## B. Desain Database

### Tabel `books`

| Column       | Type    | Description                         |
| ------------ | ------- | ----------------------------------- |
| id           | integer | Primary key                         |
| cover        | string  | URL atau path cover buku (nullable) |
| title        | string  | Judul buku                          |
| publisher    | string  | Penerbit buku (nullable)            |
| synopsis     | text    | Sinopsis buku (nullable)            |
| publish_year | integer | Tahun terbit buku (nullable)        |
| genre        | string  | Genre buku (nullable)               |
| author_id    | integer | Foreign key ke tabel authors        |

### Tabel `authors`

| Column    | Type    | Description                           |
| --------- | ------- | ------------------------------------- |
| id        | integer | Primary key                           |
| photo     | string  | URL atau path foto penulis (nullable) |
| name      | string  | Nama penulis                          |
| birthdate | date    | Tanggal lahir penulis (nullable)      |
| biography | text    | Biografi penulis (nullable)           |

### Relasi:

-   Satu `author` dapat memiliki banyak `books` (One-to-Many).

## C. Screenshot Aplikasi

### 1. Postman - CRUD Buku

![CRUD Buku](screenshots/postman_books_crud.png)

### 2. Postman - CRUD Penulis

![CRUD Penulis](screenshots/postman_authors_crud.png)

### 3. Postman - Pencarian Buku

![Pencarian Buku](screenshots/postman_books_search.png)

## D. Dependency

-   **PHP 8.x**: Bahasa pemrograman utama untuk Laravel
-   **Laravel 8.x**: Framework PHP yang digunakan untuk membangun API
-   **Laravel Sanctum**: Paket Laravel untuk otentikasi berbasis token
-   **Composer**: Dependency manager untuk PHP
-   **MySQL/MariaDB**: Database yang digunakan untuk menyimpan data buku dan penulis
-   **Postman**: Alat untuk mengetes API

### Cara Install:

1. Clone repository:

    ```bash
    git clone https://github.com/username/repository-name.git
    ```

2. Install dependencies menggunakan Composer:

    ```bash
    composer install
    ```

3. Copy `.env.example` menjadi `.env` dan konfigurasi database:

    ```bash
    cp .env.example .env
    ```

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Jalankan migrasi database:

    ```bash
    php artisan migrate
    ```

6. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

Akses API melalui Postman atau aplikasi client API lainnya.

---

Jika ada pertanyaan lebih lanjut atau ingin kontribusi, silakan buat _issue_ di repository ini. Terima kasih!
