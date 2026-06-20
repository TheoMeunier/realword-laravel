# Conduit — RealWorld Backend API · Laravel 13

> A fully featured backend REST API for the [RealWorld](https://github.com/gothinkster/realworld) "Conduit" application (Medium.com clone), built with **Laravel 13**.

This codebase was created to demonstrate a real-world backend API built with Laravel 13 including CRUD operations, JWT authentication, routing, pagination, and more. It fully adheres to the [RealWorld API spec](https://realworld-docs.netlify.app/docs/specs/backend-specs/introduction).

---

## Tech Stack

| Technology       | Version | Purpose |
|------------------|---------|---|
| PHP              | 8.4+    | Language |
| Laravel          | 13.x    | Framework |
| Postgres 17 | —       | Database |
| Laravel Sanctum  | —       | API token authentication |
| Eloquent ORM     | —       | Database abstraction |
| Pest             | 4.X     | Testing |

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

Configuration file `.env`

---

## Further Reading

- [RealWorld API Spec](https://realworld-docs.netlify.app/docs/specs/backend-specs/introduction)
- [Laravel 13 Documentation](https://laravel.com/docs/13.x)
- [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum)

---

## License

MIT
