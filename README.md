# Conduit — RealWorld Backend API · Laravel 13

> A fully featured backend REST API for the [RealWorld](https://github.com/gothinkster/realworld) "Conduit" application (Medium.com clone), built with **Laravel 13**.

This codebase was created to demonstrate a real-world backend API built with Laravel 13 including CRUD operations, JWT authentication, routing, pagination, and more. It fully adheres to the [RealWorld API spec](https://realworld-docs.netlify.app/docs/specs/backend-specs/introduction).

---

## Tech Stack

| Technology          | Version | Purpose |
|---------------------|---------|---|
| PHP                 | 8.5+    | Language |
| Laravel             | 13.x    | Framework |
| MySQL / Postgres 17 | —       | Database |
| Laravel Sanctum     | —       | API token authentication |
| Eloquent ORM        | —       | Database abstraction |
| Pest                | 11.x    | Testing |

---

## API Endpoints

The API is mounted at `/api` and implements the full RealWorld spec:

| Method | Endpoint | Auth | Description |
|---|---|---|---|
| `POST` | `/api/users/login` | No | Login |
| `POST` | `/api/users` | No | Register |
| `GET` | `/api/user` | Yes | Get current user |
| `PUT` | `/api/user` | Yes | Update current user |
| `GET` | `/api/profiles/:username` | Optional | Get profile |
| `POST` | `/api/profiles/:username/follow` | Yes | Follow user |
| `DELETE` | `/api/profiles/:username/follow` | Yes | Unfollow user |
| `GET` | `/api/articles` | Optional | List articles (filterable) |
| `GET` | `/api/articles/feed` | Yes | Get personalised feed |
| `GET` | `/api/articles/:slug` | Optional | Get article |
| `POST` | `/api/articles` | Yes | Create article |
| `PUT` | `/api/articles/:slug` | Yes | Update article |
| `DELETE` | `/api/articles/:slug` | Yes | Delete article |
| `POST` | `/api/articles/:slug/favorite` | Yes | Favourite article |
| `DELETE` | `/api/articles/:slug/favorite` | Yes | Unfavourite article |
| `GET` | `/api/articles/:slug/comments` | Optional | Get comments |
| `POST` | `/api/articles/:slug/comments` | Yes | Add comment |
| `DELETE` | `/api/articles/:slug/comments/:id` | Yes | Delete comment |
| `GET` | `/api/tags` | No | Get tags |

---

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/       # API controllers (Articles, Auth, Comments, Profiles, Tags, Users)
│   │   ├── Middleware/        # Auth middleware (token extraction & validation)
│   │   └── Requests/          # Form request validation classes
│   ├── Models/                # Eloquent models (User, Article, Comment, Tag)
│   └── Providers/             # Service providers
├── config/                    # Laravel config files (including CORS, auth, sanctum)
├── database/
│   ├── migrations/            # Database schema migrations
│   └── seeders/               # Optional seeders for test data
├── routes/
│   └── api.php                # All API route definitions
├── tests/
│   ├── Feature/               # Feature (integration) tests per endpoint group
│   └── Unit/                  # Unit tests
├── .env.example               # Example environment configuration
├── artisan                    # Laravel CLI entry point
├── composer.json              # PHP dependencies
└── phpunit.xml                # PHPUnit configuration
```

---

## Prerequisites

- **PHP** 8.4 or later
- **Composer** 2.x
- **Postgres** 17.x
- A web server or Laravel's built-in dev server

---

## Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/TomislavVinkovic/realworld-api-laravel-12.git
cd realworld-api-laravel-13
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Set up your environment file

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and update the database connection details:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=realworld
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 4. Run migrations

```bash
php artisan migrate
```

Optionally seed the database with sample data:

```bash
php artisan db:seed
```

### 5. Start the development server

```bash
php artisan serve
```

The API will be available at **[http://localhost:8888/api](http://localhost:8888/api)**.

---

## Authentication

Authentication is handled via **Bearer tokens** (Laravel Sanctum). To access protected endpoints, include the token returned on login or registration in the `Authorization` header:

```
Authorization: Token <your_token_here>
```

---

## Further Reading

- [RealWorld API Spec](https://realworld-docs.netlify.app/docs/specs/backend-specs/introduction)
- [Laravel 13 Documentation](https://laravel.com/docs/13.x)
- [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum)

---

## License

MIT
