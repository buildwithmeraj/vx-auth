# VX Auth

Laravel 13 authentication + RBAC project with:
- 3-step registration
- User ID based login
- Spatie role/permission management
- Unified dashboard with permission-based sidebar and routes
- Profile view/edit pages
- Dark/Light theme switcher

## Live Demo

- URL: [https://vxauth.meraj.pro](https://vxauth.meraj.pro)

## Requirements

- PHP 8.3+
- Composer
- Node.js + npm
- MySQL/MariaDB (or SQLite for tests)

## Setup

1. Install dependencies
   - `composer install`
   - `npm install`

2. Create environment file
   - `cp .env.example .env`

3. Configure `.env`
   - `APP_URL`
   - `DB_*` values
   - Optional mail settings (`MAIL_*`)

4. Generate key
   - `php artisan key:generate`

5. Run migrations + seeders
   - `php artisan migrate --seed`

6. Build frontend assets
   - `npm run build`

7. Start app
   - `php artisan serve`

## Authentication Flow

- Register at `/register` (3 steps).
- A random `userID` is generated (e.g. `VX123456`).
- User gets temporary credentials flow and sets password via reset screen.
- Login via `/login` using `userID` + password.

## RBAC (Spatie)

The app seeds baseline permissions and roles:

- Permissions:
  - `dashboard.view`
  - `users.view`, `users.manage`
  - `roles.view`, `roles.manage`
  - `permissions.view`, `permissions.manage`
  - `assignments.manage`

- Roles:
  - `admin` (all baseline permissions)
  - `user` (`dashboard.view` only)

Newly registered users are assigned the `user` role automatically.

## Dashboard Routes

- `/dashboard` -> Dashboard home (`dashboard.view`)
- `/dashboard/profile` -> Profile view
- `/dashboard/profile/edit` -> Profile edit
- `/dashboard/roles` -> Role management (`roles.view/manage`)
- `/dashboard/permissions` -> Permission management (`permissions.view/manage`)
- `/dashboard/users` -> User access management (`users.view`, `assignments.manage`)

## Admin Seeder

Admin credentials are now defined directly in:

- `database/seeders/AdminUserSeeder.php`

Default seeded values:
- Email: `admin@example.com`
- User ID: `VX000001`
- Password: `Admin12345`

Run seed:
- `php artisan db:seed`

## Frontend Notes

- DaisyUI drawer sidebar for dashboard pages.
- Theme toggle (dark/light) stored in `localStorage`.

## Tests

Run all tests:
- `php artisan test`

Run a specific test:
- `php artisan test --filter=DashboardAccessTest`

## Notes

- If you changed role/permission seed values, reseed with:
  - `php artisan migrate:fresh --seed`
- `database/sql/vx_auth.sql` may be out of date compared to latest migrations.
