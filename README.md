# CI4 Auth JWT
Aplikasi Restful dengan CodeIgniter 4. Studi kasus auth dengan jwt.

## Cara instalasi:
- Clone repo ini.
- Jalankan `composer install`.
- Konfigurasi env lalu jalankan `php spark migrate`.
- Jalankan `php spark serve`, server akan berjalan di `http://localhost:8080`.

## Endpoint yang tersedia:
- Register
  - Endpoint: http://localhost:8080/register
  - Body: email (required, string), password (required, string), password_confirm (required, string).
  - Desc: Endpoint untuk melakukan register.

- Login
  - Endpoint: http://localhost:8080/login
  - Body: email (required, string), password (required, string).
  - Desc: Endpoint untuk melakukan login. Pada langkah ini akan mendapatkan JWT token.

- Me
  - Endpoint: http://localhost:8080/me
  - Header: Authorization (JWT token yang didapatkan dari login).
  - Desc: Endpoint untuk mendapatkan data user.

Hasil belajar dari tutorial: https://youtu.be/lPHp2cbO6d0
