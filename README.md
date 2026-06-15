# Daily Awareness Tracker

A Laravel application for tracking essential daily stats. Users can log creative work hours, rate the quality of their day, write a daily note, and define their own custom metrics to track their own preferences.

---

## Features

- Secure user registration and login (Laravel Breeze)
- Log daily entries: hours of creative work, quality score (−2 to +2), and a note
- Create and manage fully custom metrics (e.g. "times I got angry", "glasses of water")
- Attach custom metric values to each daily entry
- View and edit historical entries
- Mobile-responsive UI built with Tailwind CSS
- Form validation on every input with user-friendly error messages
- Per-user data isolation — users can only access their own records
- **Bonus:** Scheduled daily reminder email sent to any user who hasn't logged today's entry

---

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- SQLite 

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
cp .env.example .env        # Mac/Linux
copy .env.example .env      # Windows
php artisan key:generate
```

The default configuration uses SQLite — no database server required. Create the SQLite file:

```bash
touch database/database.sqlite          # Mac/Linux
New-Item database/database.sqlite       # Windows (PowerShell)
```

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Seed demo data (optional)

Populates sample users, 30 days of daily entries, and custom metrics per user so you can explore the app immediately:

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

Visit `http://127.0.0.1:8000`, register an account (or use the demo account above), and start tracking.

---

## Bonus Feature — Daily Reminder Emails

An Artisan command sends a reminder email to any user who has not yet logged an entry for today.

### Run manually

```bash
php artisan reminders:send-daily
```

### Mail configuration

Set `MAIL_MAILER` in `.env` to your preferred driver:

| Driver | Use case |
|---|---|
| `log` *(default)* | Local dev — email HTML is written to `storage/logs/laravel.log` |
| `smtp` + [Mailpit](https://github.com/axllent/mailpit/releases/latest) | Local dev — view fully rendered emails at `http://localhost:8025` |
| `smtp` | Production — point at a real mail provider via `.env` SMTP credentials |

To test visually with Mailpit locally:
1. Download and run `mailpit.exe` (Windows) or `./mailpit` (Mac/Linux)
2. Set `MAIL_MAILER=smtp` and `MAIL_PORT=1025` in `.env`
3. Run `php artisan reminders:send-daily`
4. Open `http://localhost:8025` to see the rendered email

---

## Running the Tests

All tests are written with Pest PHP and use an in-memory SQLite database — fully isolated from your development data. No extra configuration needed.

```bash
php artisan test
```


### Test coverage

| File | What is tested |
|---|---|
| `Auth_ProtectionTest` | Guests are redirected to login; authenticated users can access routes |
| `DailyEntryTest` | Create, update, delete entries; metric values saved and associated correctly |
| `Custom_MetricTest` | Create and delete custom metrics; ownership enforced |
| `Custom_MetricValueTest` | Store metric values; upsert prevents duplicates |
| `DailyReminderTest` | Reminder sent only to users missing today's entry; no email when all users have logged |

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
| Backend | Laravel 13 |
| Auth | Laravel Breeze |
| Frontend | Blade templates, Tailwind CSS |
| Database | SQLite |
| Testing | Pest PHP |

---

## Design Decisions

- **Custom Metrics** — Rather than a fixed schema, users can create named metrics with a unit, then attach numeric values to each daily entry. This keeps the core `daily_entries` table clean while supporting unlimited extensibility per user.
- **Quality Score** — Stored as a signed integer (−2 to +2) matching the Jim Collins scale. Displayed with a colour-coded badge (emerald for great days, red for bad ones) so trends are easily visible.
- **Authorization** — Every controller action re-verifies `user_id` ownership before reading, updating, or deleting a record. This double-checks beyond route middleware so ownership is enforced at the model layer regardless of how a route is reached. Users cannot access each other's data even by guessing IDs.
- **Rate limiting** — Laravel's built-in `throttle` middleware is applied to login to defend against brute-force attacks.
- **Upsert on metric values** — `CustomMetricValueController` uses `updateOrCreate` so re-submitting a day's entry updates existing values rather than creating duplicates.
- **Index view** — Entries are sorted newest-first so the most relevant entry is always at the top. Each row shows the date, a colour-coded quality score badge, creative hours, metric count, and a truncated note snippet — giving a full picture at a glance without opening each entry individually.
- **Update & Delete** — The delete button uses an inline `POST` form with `@method('DELETE')` since HTML forms do not natively support the `DELETE` verb. A JavaScript `confirm()` prompt guards against accidental deletion.
- **Reminder email** — Implemented as an Artisan command (`reminders:send-daily`) that finds users with no entry today and sends them a reminder. The Mailable uses inline CSS throughout because email clients (Gmail, Outlook) strip external stylesheets.

