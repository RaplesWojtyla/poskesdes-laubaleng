<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## - [Intro](#intro)
## - [Instalasi Dan Konfigurasi](#instalasi-dan-konfigurasi)
## - [Kontributor](#Kontributor)
## - [Source](#source)

# [Intro](#intro)
Website ini merupakan aplikasi berbasis web yang dirancang untuk membantu Pos Kesehatan Desa (Poskesdes) Laubaleng dalam mengelola data secara efisien dan terorganisir. Sistem ini dibuat untuk menggantikan proses manual yang selama ini digunakan, seperti pencatatan transaksi dengan pembukuan dan pengelolaan data obat menggunakan file Excel.

Dengan mengintegrasikan semua data dalam satu platform, website ini mendukung operasional Poskesdes, termasuk pencatatan transaksi penjualan, penyimpanan data obat, dan manajemen akun pengguna. Selain itu, pelanggan dapat dengan mudah mengakses informasi obat dan melakukan pemesanan secara online, sehingga meningkatkan aksesibilitas dan kualitas pelayanan. Website ini juga sudah terintegrasi dengan payment gateway, memudahkan proses pembayaran transaksi secara online dengan aman dan cepat.

# Instalasi Dan Konfigurasi
- ## Tech
    [<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" height="30" alt="laravel logo" />](#laravel-10)
    <img width="12" />
    [<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/livewire/livewire-original.svg" height="30" alt="csharp logo" />](#livewire)
    <img width="12" />
    [<img src="https://shop.filamentphp.com/cdn/shop/files/Logo-2.png" height="30" alt="filament logo" />](#filament)
    <img width="12" />
    [<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg" height="30" alt="laravel logo" />](#tailwind-css)


 - ## Instalasi
   - #### Lakukan Clone pada Github Repositori ini
        - Klik tombol "Code" (berwarna hijau) untuk mendapatkan URL repository. Jika menggunakan HTTPS, salin URL tersebut. Jika menggunakan SSH, klik ikon SSH dan salin URL SSH.
        - Buka terminal, command prompt atau Git Bash(rekomendasi) di komputer Anda.
        - Pindah ke direktori di mana Anda ingin menyimpan salinan lokal repository. Gunakan perintah cd untuk berpindah ke direktori tersebut.
          #### Contoh:
              cd path/ke/direktori/tujuan
        - Gunakan perintah git clone dengan menyertakan URL repository yang telah Anda salin sebelumnya.
          #### Contoh untuk HTTPS:
              git clone https://github.com/nama-akun/nama-repo.git
          #### Atau untuk SSH:
              git clone git@github.com:nama-akun/nama-repo.git
   - #### Jalankan Di Code Editor
       - Buka Terminal di direktori penyimpanan project.
   - #### Install Dependensi
     #### - Jalankan perintah berikut:
         composer install
     #### - Selanjutnya, jalankan perintah berikut:
         npm install
   - #### Buat Salinan File Konfigurasi
     - Salin file `.env.example` dan beri nama baru menjadi `.env`
       #### Jalankan Perintah Berikut:
           cp .env.example .env
   - #### Konfigurasi file `.env`
     - # Masukkan pengaturan untuk storage file .env
             FILESYSTEM_DISK=public
     - Buka file `.env` dan konfigurasi pengaturan database, koneksi email, dan login google.
       ### Pengaturan database
       #### Ubah sesuai dengan nama database yang dibuat:
             DB_DATABASE=<nama_database>
         
       ### Pengaturan Mail
       #### Ubah sesuai kebutuhan:
            MAIL_MAILER=smtp
            MAIL_HOST=<host_yang_digunakan>
            MAIL_PORT=<port_mail>
            MAIL_USERNAME=Username
            MAIL_PASSWORD=Password
            MAIL_ENCRYPTION=null
            MAIL_FROM_ADDRESS="poskesdeslaubaleng@gmail.com"
            MAIL_FROM_NAME="Poskesdes Lau Baleng"

       ### Pengaturan Midtrans (Payment Gateway)
       - Register/Login ke midtrans.com
       - Ubah Environtment menjadi: Sandbox (default: Production)
       - Masuk ke SETTINGS -> ACCESS KEYS
       - Lalu 
       #### Ubah <YOUR_MIDTRANS_SERVER_KEY>, dan <YOUR_MIDTRANS_CLIENT_KEY> sesuai dengan yang tertera pada midtrans anda:
            MIDTRANS_SERVER_KEY=<YOUR_MIDTRANS_SERVER_KEY>
            MIDTRANS_CLIENT_KEY=<YOUR_MIDTRANS_CLIENT_KEY>
            MIDTRANS_IS_PRODUCTION=false
            MIDTRANS_IS_SANITIZED=true
            MIDTRANS_IS_3DS=true 
       
   - #### Gunakan Laragon (Tidak disarankan menggunakan XAMPP)
   - #### Generate Application Key
     #### Jalankan perintah berikut di terminal:
         php artisan key:generate
   - #### Jalankan Migrasi
     Jalankan perintah migrasi untuk membuat struktur table
     #### jalankan perintah berikut:
         php artisan migrate
     Jalankan perintah seeder untuk mengisi data pada table dengan data dummy
     #### jalankan perintah berikut:
         php artisan db:seed
   - #### Jalankan Server Lokal
     #### jalankan perintah berikut:
         php artisan serve
     #### lalu
         php artisan storage:link
     #### dan
         npm run dev
   - #### Buka Proyek di Browser
      Buka browser dan kunjungi alamat yang ditampilkan di terminal. Biasanya, ini adalah `http://127.0.0.1:8000`.

     ## Login Level: User 
         Email: -cek dimysql-
         Password: qwertyui
     ## Login Level: Cashier
         Email: -cek dimysql-
         Password: 12345678 
     ## Login Level: Owner
         Email: owner@gmail.com
         Password: 1234567890 

# [Kontributor](#kontributor)
- ### Patra Rafles Wostyla Sinaga
  - Instagram: @raples.wojtyla
  - Role: Full-Stack Web Developer and Database Administrator
- ### Susi Pujiarti Butar-Butar
  - Instagram: @susi_pujiarti_
  - Role: Nyusun Laporan Akhir dan PPT
- ### Zaizha Michella
  - Instagram: @zmichellaa
  - Role: Nyusun Laporan Akhir dan PPT
- ### Evan Arga Ignatius Hutagalung
  - Instagram: @evanhutagalung63
  - Role: Nyusun PPT
- ### Geri Nugraha Sitepu
  - Instagram: @geri.ngrha
  - Role: Nyusun PPT

# [Source](#source)
- ## [<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" height="30" alt="laravel logo" /> Laravel 10](#laravel-10)
  https://laravel.com/docs/10.x
- ## [<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/livewire/livewire-original.svg" height="30" alt="livewire logo" /> Livewire](#livewire)
  https://livewire.laravel.com/docs/quickstart
- ## [<img src="https://shop.filamentphp.com/cdn/shop/files/Logo-2.png" height="30" alt="filament logo" />](#filament)
  https://filamentphp.com/docs
- ## [<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg" height="30" alt="laravel logo" /> Tailwindcss](#tailwind-css)
  https://tailwindcss.com/docs/installation

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
