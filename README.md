This file provides instructions on setting up and running the Laravel application.

## Prerequisites:
Laravel 11 <br>
PHP (version 8.3 or higher recommended) <br>
Composer (package manager for PHP) <br>
Database (MySQL) <br>

## Installation:

Clone the repository:<br>
git clone https://github.com/robingitpro/coding-exercise.git <br>
Navigate to the project directory: <br>
cd your-repository-name

## Install dependencies:
composer install <br>
## Generate application key: 
php artisan key:generate
## Configure database settings:
Copy .env.example to .env.<br>
Edit the .env file and update the database connection details (host, database name, username, password).


## Migrate database schema:

php artisan migrate

## Seed database:
php artisan db:seed --class=UserSeeder

## Running the application:

Start development server: <br>
php artisan serve
This will start the development server, typically accessible at http://localhost:8000 in your web browser.

## Login Details
username : admin@gmail.com <br>
password : 123456

This README file provides a basic structure for getting your Laravel application up and running. You can customize it further to include additional information specific to your project.
