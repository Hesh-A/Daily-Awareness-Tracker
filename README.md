# Daily Awareness Tracker

A simple Laravel application to help users track essential daily awareness goals. Users can log creative work hours, rate the quality of their day, add notes, and define fully custom metrics to track whatever matters most to them.


## Features

- Secure user registration and login (Laravel Breeze)
- Log daily entries: hours of creative work, quality score (−2 to +2), and a note
- Create and manage fully custom metrics (e.g. "times I got angry", "glasses of water")
- Attach custom metric values to each daily entry
- View and edit historical entries
- Mobile responsive UI built with Tailwind CSS
- Form validation on every input with user-friendly error messages
- Per-user data isolation — users can only access their own records


---

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- SQLite (default)

---

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

### 6. Seed demo data (optional)

Populates sample users, 30 days of daily entries, and custom metrics per user:

```bash
php artisan migrate:fresh --seed
```

Demo account:
- **Email:** `test@example.com`
- **Password:** `password`

### 7. Build frontend assets

```bash
npm run build
```

### 8. Start the development server

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000`, register an account, and start tracking.

---

## Database Schema & Relationships

```
users
 ├── hasMany ──► daily_entries
 └── hasMany ──► custom_metrics

daily_entries
 ├── belongsTo ──► users
 └── hasMany   ──► custom_metric_values

custom_metrics
 ├── belongsTo ──► users
 └── hasMany   ──► custom_metric_values

custom_metric_values
 ├── belongsTo ──► daily_entries
 └── belongsTo ──► custom_metrics
```

### Key fields

| Table | Notable columns |
|---|---|
| `users` | `name`, `email`, `password` |
| `daily_entries` | `user_id`, `entry_date`, `hours_creative_work`, `quality_score` (−2 to +2), `notes` |
| `custom_metrics` | `user_id`, `name`, `unit` |
| `custom_metric_values` | `daily_entry_id`, `custom_metric_id`, `value` |

A `custom_metric_value` row links a specific metric to a specific day's entry, allowing each user's daily entry to carry an arbitrary number of user-defined tracked values.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 11 |
| Auth | Laravel Breeze |
| Frontend | Blade templates, Tailwind CSS |
| Database | SQLite |
| Testing | Pest PHP |

---

## Design Decisions

- **Custom Metrics** — The spec asks for extensibility ("define their own custom metric"). Rather than a fixed schema, users can create named metrics with a unit, then attach numeric values per day. This keeps the core table clean while allowing more flexibility.
- **Quality Score** — Stored as a signed integer (−2 to +2).
- **Authorization** — Every controller action verifies `user_id` ownership before reading, updating, or deleting a record. Users cannot access each other's data even by guessing IDs.
- **Rate limiting** — Laravel's built-in `throttle` middleware is applied to login to defend against brute-force attacks.
- **Upsert on metric values** — The `CustomMetricValueController` uses `updateOrCreate` so re-submitting a day's entry updates existing values rather than creating duplicates.


## Testing

Feature tests written with Pest PHP covering:

- Authentication — guest redirect, authenticated access protection
- Daily entry CRUD — create, update, delete, metric values persisted correctly
- Custom metric CRUD — create, delete, ownership checks
- Custom metric value — store and upsert behaviour

```bash
php artisan test
```

All tests use an in-memory SQLite database and are fully isolated from the development database.
