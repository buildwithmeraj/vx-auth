# VX Auth

Laravel project for a role-based authentication flow with a 3-step registration form and a user ID based login.

## Live Demo

- URL: [https://https://meraj.pro/vx-auth/](https://meraj.pro/vx-auth/)

## Requirements

- PHP and Composer
- Node.js and npm
- MySQL/MariaDB

## Setup

1. Install dependencies:
    - `composer install`
    - `npm install`

2. Create your environment file:
    - `cp .env.example .env`

3. Configure `.env`:
    - Set `APP_URL`
    - Set `DB_*` credentials
    - (Optional) Set `MAIL_*` credentials to send emails

4. Generate the app key:
    - `php artisan key:generate`

5. Run database migrations:
    - `php artisan migrate`

6. Build frontend assets:
    - `npm run build`

7. Start the app:
    - `php artisan serve`

## Usage

- Register from `/register` (3 steps). After completion you will receive a generated User ID by email (if mail is configured).
- Log in from `/login` using your User ID.
- After first login (when password is not set), set a password from the reset password page.

## Database (SQL)

- SQL dump file: `database/sql/vx_auth.sql`

## Admin account (optional)

To seed a predefined admin account:

1. Set these values in `.env`:
    - `ADMIN_EMAIL=admin@example.com`
    - `ADMIN_USERID=VX000001`
    - `ADMIN_PASSWORD=Admin12345`

2. Run:
    - `php artisan db:seed`

Then log in from `/login` using the `ADMIN_USERID` and `ADMIN_PASSWORD`.
