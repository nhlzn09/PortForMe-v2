# PortForMe: Online Portfolio Template Generator

Made by Group 7. Users sign up, enter their information, save it to an online MySQL database, pick one of
three templates (Simple, Modern, Creative), preview the generated portfolio, and edit or delete it later.
Every portfolio also gets a public link: `/u/<username>`.

Built with **Laravel (PHP) + MySQL**. Hosting and database setup is in **DEPLOY.md**.

## Run it on your computer (XAMPP or Laravel Herd)

1. Start MySQL (XAMPP Control Panel, MySQL row, Start) and create an empty database called `portforme`
   (phpMyAdmin, New, name `portforme`, collation `utf8mb4_general_ci`).
2. In this folder:
   ```
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
3. Open `.env` and set:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=portforme
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Create the tables and start the site:
   ```
   php artisan migrate
   php artisan serve
   ```
   Then open http://127.0.0.1:8000

If you already ran an older version of this project on the same database, use `php artisan migrate:fresh`
instead of `migrate` (this erases that database's data).

## System flow

Home -> Create Portfolio -> Enter information -> Save to online database -> Select 1 of 3 templates ->
Generate -> Preview -> Edit / Delete.

| Page | Address |
|---|---|
| Home | `/` |
| Portfolio Information (create/edit) | `/portfolio/create`, `/portfolio/edit` |
| Template Selection | `/portfolio/template` |
| Portfolio Preview | `/portfolio/preview` |
| Manage Portfolio (view, edit, delete) | `/dashboard` |
| Public portfolio | `/u/<username>` |

Never commit your `.env` file. It holds your database password.
