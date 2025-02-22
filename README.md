<h1 style="text-align:center; font-weight:bolder;">Catatan Sebelum Melakukan Git Clone</h1>

## Beberapa Catatan Terkait Penggunaan Repository Ini
1. Silahkan melakukan kloning pada repository ini dengan melakukan copy url repository

2. Setelah melakukan kloning ketikan di terminal perintah berikut. Bertujuan agar APP KEY update otomatis dan vendor akan terinstal serta .env akan terbentuk. Jangan lupa lakukan konfigurasi pada database seperti username, password, host, dan database name
     ```shell
        composer install
     ```
     ```shell
        cp .env.example .env
     ```
     ```shell
        php artisan key:generate
     ```
     ```shell
        php artisan migrate --seed
     ```
