# Group1-CMS
# Technologies
1. PHP 8.0.11
2. Laravel 8.69.0
3. Composer 2.1.9
4. MySQL 8.0.26
# Development Setup
1. Create .env(copy contents for .env.example)
2. Run the following :
```
composer install
composer dumpautoload -o
php artisan key:generate
php artisan migrate:install
php artisan migrate
php artisan db:seed
php artisan serve
```
