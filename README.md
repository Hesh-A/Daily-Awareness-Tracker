# Daily Tracker

A personal productivity web app built with Laravel. Track your daily creative work hours, rate the quality of your day, add notes, and define custom metrics to monitor whatever matters to you.

## Features

- Register and log in securely
- Log daily entries (date, hours of creative work, quality score, notes)
- Create and manage custom metrics (e.g. mood, exercise, focus)
- Attach custom metric values to each daily entry
- Mobile responsive UI

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- SQLite Database

## Setup

### 1. Clone the repository

```bash
git clone <your-repo-url>
cd daily_tracker
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Configure environment

Copy the example env file and generate an app key:

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and set your database connection. For a quick local setup with SQLite:

```env
DB_CONNECTION=sqlite
```

Then create the SQLite file:

```bash
touch database/database.sqlite
```

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Build frontend assets

```bash
npm run build
```

### 7. Start the development server

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000`, register an account, and start tracking.

## Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade templates, Tailwind CSS
- **Auth:** Laravel Breeze
- **Database:** SQLite / MySQL / PostgreSQL (configurable)

## Seeding Demo Data

To populate the database with sample users, entries, and metrics:

```bash
php artisan migrate:fresh --seed
```

A demo account will be created:
- **Email:** `test@example.com`
- **Password:** `password`

## Design Decisions

- **Custom Metrics** — Users can define their own tracking categories (e.g. mood, exercise, focus) and attach values to each daily entry. This makes the tracker flexible rather than rigid.
- **Quality Score** — Stored as an integer from −2 to +2, giving a simple but meaningful range (bad → poor → neutral → good → great).
- **Authorization** — Every controller checks `user_id` ownership before allowing updates or deletes, preventing users from accessing each other's data.
- **Rate limiting** — Laravel's built-in `throttle` middleware is applied to the login route to protect against brute force attacks.
- **SQLite for testing** — `phpunit.xml` uses an in-memory SQLite database so tests run fast without touching the real database.

## Testing

11 feature tests covering:
- Authentication (guest redirect, authenticated access)
- Daily entry CRUD (create, update, delete, metric values saved)
- Custom metric CRUD (create, delete)
- Custom metric value store + upsert behaviour

```bash
php artisan test
```
