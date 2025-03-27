# langkah-langkah penginstalan

Update source codes terbaru
`git pull`

Instal composer (jika pertama kali pull laravel project)
`composer install`

Siapkan file `.env` copy atau lihat cotoh dari vile `.env.example`

Buat database baru dengan nama yang sama dengan nama database di file `.env`
```
DB_DATABASE=app_inventaris_si_uncen
```

Jalankan migrasi database ```php artisan migrate```