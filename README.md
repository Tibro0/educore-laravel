# Edu Core Website

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x%2B-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)

A brief description of your Laravel project and its purpose.

## ✨ Features

- HTML, CSS, Javascript
- Ajax, OAuth
- Facebook Login, Google Login
- RESTful API endpoints
- Authentication & Authorization
- Database migrations & seeders
- Task scheduling with Laravel Scheduler
- Queue jobs for background processing
- Real-time features with Laravel Echo (if applicable)

## 📋 Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.3.29
- Composer 2.9.5
- Node.js >= 22.22.0 (if using frontend build tools)
- NPM or Yarn
- Database (MySQL)
- Web server (Apache/Nginx) or PHP built-in server
- Laravel Breeze
- OAuth

## 🚀 Installation

Follow these steps to set up the project locally:

1. **Clone the repository**

```bash
git clone https://github.com/Tibro0/educore-laravel.git educore-laravel
cd educore-laravel
```

2. **Install PHP Dependencies**

```bash
composer install
cp .env.example .env
php artisan key:generate
```
3. **Configure Environment Variables** <br>
   Edit the .env file with your database credentials and other settings:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
4. **Run database migrations and seeders**

```bash
php artisan migrate:fresh --seed
```

5. **Start The Development Server**

```bash
php artisan serve
```

6. **Access The Application**

```bash
http://127.0.0.1:8000/
```
