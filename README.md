# 📌 Absensi Berbasis QR Code

Sistem absensi berbasis QR Code menggunakan Laravel.

## 🚀 Cara Menjalankan Project

### 1. Clone Repository
git clone https://github.com/ArifRahmanHakim13/absensi.git
cd absensi

### 2. Install Dependency
composer install
npm install

### 3. Setup Environment
cp .env.example .env
php artisan key:generate

### 4. Setup Database
Edit file .env:
DB_DATABASE=absensi
DB_USERNAME=root
DB_PASSWORD=

### 5. Migrasi Database
php artisan migrate

### 6. Jalankan Project
php artisan serve

### 7. Buka di Browser
http://127.0.0.1:8000

## 👨‍💻 Developer
Arif Rahman Hakim
