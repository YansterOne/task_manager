# Task manager
Demo: https://task-manager.yanster.one  

## Installation 
Run these commands to install the project:  

```bash
composer install
php artisan key:generate
php artisan migrate
npm install
npm run prod 
```

You must set environment variables in file `.env` (application name, url, database connection).

## Tests
Run this command for run tests: 
```bash
./vendor/bin/phpunit
```
