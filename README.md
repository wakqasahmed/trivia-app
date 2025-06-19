# Laravel Trivia App

A web application that fetches trivia questions from the Open Trivia Database and allows users to take quizzes.

## Features

- User-friendly quiz interface
- Question filtering by difficulty and type
- Search history tracking
- Admin panel for managing quiz history
- Responsive design with Bootstrap 5

## Requirements

- PHP 8.1+
- Composer
- MySQL
- Node.js
- npm

## Local Development Setup

1. Clone the repository:
   ```bash
   git clone https://www.github.com/wakqasahmed/trivia-app.git
   cd trivia-app

2. Install PHP dependencies:
   ```bash
   composer install

3. Install Node.js dependencies:
   ```bash
   npm install
   
4. Create and configure the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate

5. Run migrations:
   ```bash
   php artisan migrate

6. Start the development server:
   ```bash
   php artisan serve

8. Open your browser and navigate to:
   ```bash
   http://localhost:8000

## Access the Admin Panel

1. Generate admin user:
   ```bash
   php artisan make:filament-user

2. Open your browser and navigate to:
   ```bash
   http://localhost:8000/admin

3. Login using the generated credentials:
   ```bash
   Email: your_admin_email@example.com
   Password: your_admin_password

## Running Tests

To run the tests, use the following command:
```bash
php artisan test
```

## Improvements
- Let's discuss over the call, shall we?