# PHP_Laravel12_Scramble
## Overview

A simple Laravel project demonstrating how to use **Dedoc Scramble** to automatically generate OpenAPI / Swagger‑like API documentation.

This project shows how to build a clean REST API and instantly produce interactive API documentation without writing complex configuration files.

---

## Features

* Laravel 12 API Project
* CRUD API for Posts
* Factory and Seeder
* API Resources and Collections
* Form Request Validation
* Automatic API Documentation with Scramble
* Interactive Documentation UI

---

## Requirements

* PHP 8.2 or higher
* Composer
* MySQL or MariaDB
* Node (Optional)
* Laravel 12

---

## Installation

### Step 1: Create New Laravel Project

```bash
composer create-project laravel/laravel laravel-scramble-example
cd laravel-scramble-example
```

### Step 2: Install Scramble

```bash
composer require dedoc/scramble
```

### Step 3: Publish Scramble Configuration (Optional)

```bash
php artisan vendor:publish --provider="Dedoc\Scramble\ScrambleServiceProvider" --tag="config"
```

This command creates:

```
config/scramble.php
```

---

## Database Setup

Configure `.env` file:

```
DB_DATABASE=laravel_scramble
DB_USERNAME=root
DB_PASSWORD=
```

Create the database manually in MySQL or phpMyAdmin.

---

## Create Model and Migration

```bash
php artisan make:model Post -m
```

Edit the migration file:

```
$table->id();
$table->string('title');
$table->text('content');
$table->timestamps();
```

Run migration:

```bash
php artisan migrate
```

---

## Factory and Seeder

Create factory:

```bash
php artisan make:factory PostFactory
```

Create seeder:

```bash
php artisan make:seeder PostSeeder
```

Run seeder:

```bash
php artisan db:seed --class=PostSeeder
```

---

## API Resources

Create resource:

```bash
php artisan make:resource PostResource
```

Create collection:

```bash
php artisan make:resource PostCollection
```

---

## Form Request Validation

```bash
php artisan make:request StorePostRequest
```

Validation rules example:

```
'title' => 'required|string|max:255',
'content' => 'required|string',
```

---

## API Controller

```bash
php artisan make:controller Api/PostController --api --model=Post
```

Controller methods:

* index
* store
* show
* update
* destroy

---

## API Routes

`routes/api.php`

```
Route::apiResource('posts', PostController::class);
```

---

## Scramble Configuration

`app/Providers/AppServiceProvider.php`

```
Scramble::configure()
    ->withOpenApi(function (OpenApi $openApi) {
        $openApi->info(
            description: 'Sample Blog API Documentation'
        );
    });
```

---

## API Documentation Comments (Optional)

Example:

```
/**
 * List all posts
 * @queryParam page integer
 * @queryParam per_page integer
 */
```

Scramble automatically detects most information even without comments.

---

## Run Project

```bash
php artisan serve
```

---

## API Documentation URLs

### JSON Documentation

```
http://localhost:8000/docs/api.json
```

### Interactive UI

```
http://localhost:8000/docs/api
```

---

## Screenshots (Optional)

Create a `screenshots` folder and reference images:

```
![API UI](screenshots/api-ui.png)
```

---

## Project Structure

```
app/
 ├── Http/
 │   ├── Controllers/Api/PostController.php
 │   ├── Requests/StorePostRequest.php
 │   └── Resources/
database/
 ├── factories/
 ├── seeders/
routes/
 └── api.php
```

---

## Contributing

Pull requests are welcome.
For major changes, open an issue first to discuss what you would like to change.

---

## License

MIT License
