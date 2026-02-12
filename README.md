# PHP_Laravel12_Scramble

A simple Laravel project demonstrating how to use Dedoc Scramble to automatically generate OpenAPI / Swagger-like API documentation.

Features

Laravel 12 API Project

CRUD API for Posts

Factory and Seeder

API Resources and Collections

Form Request Validation

Automatic API Documentation with Scramble

Interactive Documentation UI

Requirements

PHP 8.2 or higher

Composer

MySQL or MariaDB

Node (Optional)

Laravel 12

Installation
Step 1: Create New Laravel Project
composer create-project laravel/laravel laravel-scramble-example
cd laravel-scramble-example

Step 2: Install Scramble
composer require dedoc/scramble

Step 3: Publish Scramble Config (Optional)
php artisan vendor:publish --provider="Dedoc\Scramble\ScrambleServiceProvider" --tag="config"


This will create:

config/scramble.php

Database Setup

Configure .env file:

DB_DATABASE=laravel_scramble
DB_USERNAME=root
DB_PASSWORD=

Create Model and Migration
php artisan make:model Post -m


Edit the migration file:

$table->id();
$table->string('title');
$table->text('content');
$table->timestamps();


Run migration:

php artisan migrate

Factory and Seeder

Create factory:

php artisan make:factory PostFactory


Create seeder:

php artisan make:seeder PostSeeder


Run seeder:

php artisan db:seed --class=PostSeeder

API Resources

Create resource:

php artisan make:resource PostResource


Create collection:

php artisan make:resource PostCollection

Form Request Validation
php artisan make:request StorePostRequest


Validation rules example:

'title' => 'required|string|max:255',
'content' => 'required|string',

API Controller
php artisan make:controller Api/PostController --api --model=Post


Controller methods:

index

store

show

update

destroy

API Routes

routes/api.php

Route::apiResource('posts', PostController::class);

Scramble Configuration

app/Providers/AppServiceProvider.php

Scramble::configure()
    ->withOpenApi(function (OpenApi $openApi) {
        $openApi->info(
            description: 'Sample Blog API Documentation'
        );
    });

API Documentation Comments (Optional)

Example:

/**
 * List all posts
 * @queryParam page integer
 * @queryParam per_page integer
 */


Scramble automatically detects most information even without comments.

Run Project
php artisan serve

API Documentation URLs

JSON Documentation:

http://localhost:8000/docs/api.json


Interactive UI:

http://localhost:8000/docs/api

Screenshots (Optional)

Create a screenshots folder and reference images:

![API UI](screenshots/api-ui.png)

Project Structure
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

Contributing

Pull requests are welcome.
For major changes, open an issue first to discuss what you would like to change.

License

MIT License
