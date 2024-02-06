Laravel 10

Upload Gambar:
https://www.youtube.com/watch?v=CnqsB0ERlcI&t=1666s <br>
view gambar:<br>
composer require intervention/image

Jika larval tidak berjalan dengan normal ketika ada perubahan route: php artisan optimize

Menampilkan kode kustom validation : php artisan lang:publish

Menjalankan laravel dijaringan : php artisan serve --host 0.0.0.0

Upload project ke GitHub:
1. git init
2. git add README.md
3. git add .
4. git commit -m "first commit"
5. git remote add origin https://github.com/userName/repoName.git / git remote set-url origin git@github.com:username/repository.git
6. git push --force origin master

Jika terjadi error coba gunakan:
1. git fetch origin master:tmp
2. git rebase tmp
3. git push origin HEAD:master
4. git branch -D tmp

Referensi: https://stackoverflow.com/questions/28429819/rejected-master-master-fetch-first

Cara clone/mengambil project dari GitHub:
1. git clone url_project di GitHub (ambil project dari GitHub)
2. Composer update (update dependence yang dibutuhkan)
3. Php artisan key:generate (membuat key ke file .env)
4. Php artisan migrate (membuat/memasukkan tabel)
5. Php artisan db:seed —class=nama_class_seeder (input data awal) 
