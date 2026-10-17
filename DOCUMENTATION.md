# Project Documentation

**Project title:** PortForMe, Online Portfolio Template Generator
**Group:** Group 7

**Published website URL:** _paste your Render link here_

## Description
A database-driven website where users create an account, enter their personal information, education, skills,
projects, work experience and social links, save them to an online database, choose one of three portfolio
templates, preview the generated portfolio, and edit or delete it. Each portfolio has a public link.

## Technologies used
PHP 8.4, Laravel, Blade templates, MySQL, HTML, CSS, JavaScript, Docker.

## Database platform
Aiven for MySQL (free plan). Database project: _write your Aiven project name here_.
(Credentials are kept in environment variables and are not part of the source code.)

## Hosting / deployment platform
Render (Docker web service).

## Database structure
All child tables belong to one portfolio and are deleted with it (`ON DELETE CASCADE`).

| Table | Columns |
|---|---|
| `users` | id, name, username (unique), email (unique), password (hashed), timestamps |
| `portfolios` | id, user_id (unique, FK to users), template (`simple`/`modern`/`creative`), full_name, headline, email, phone, address, about, photo, timestamps |
| `educations` | id, portfolio_id (FK), school, degree, years |
| `skills` | id, portfolio_id (FK), name |
| `projects` | id, portfolio_id (FK), title, description, image |
| `experiences` | id, portfolio_id (FK), company, role, years, description |
| `social_links` | id, portfolio_id (FK), label, url |

Pictures (`portfolios.photo`, `projects.image`) are resized by the server and stored in the database itself, so they
survive restarts of the website host. Login sessions are also stored in the database (`sessions` table).

## CRUD
- **Create:** Create Portfolio form saves the portfolio and all its rows.
- **Read:** Preview page, public page `/u/<username>`, Manage page.
- **Update:** Edit information form; Change template.
- **Delete:** Delete button on the Manage page.

## Screenshots (add yours)
1. Home page
2. Portfolio information form
3. Template selection page
4. Preview page
5. Manage page
6. Simple template
7. Modern template
8. Creative template
9. Database tables in the online database
