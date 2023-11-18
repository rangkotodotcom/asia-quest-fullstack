# To Do List Fullstack

Create With Laravel 8 and Vue 3

## Installation

```
composer install
```

Create Database
```
mysql -u your_db_username -p your_db_password
CREATE DATABASE db_name;
exit;
```

Go to the Project Root Directory

```
cp .env.example .env
php artisan key:generate
```

```shell
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Run Migration

```
php artisan migrate
```

## Usage

```
php artisan serve
```

Open your browser and access http://127.0.0.1:8000

Thanks!
