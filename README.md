## Requirements
- PHP >= 7.1
- MySQL >= 5.5
- Composer

## Installation
Clone this repo onto your devise.

Run following commands in main project directory:
```bash
composer install
```

## Configuration
Create file `.env.local` in main application directory (next to `.env`)
and add following line into it replacing default database data with values correct for yours
environment.
```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

## List preparation
To add 20 random users to database run:
```bash
bin/console app:generate_users 20
```

## Running application
You can configure nginx or apache server to point to `public` directory (use `index.php` file)
or use Symfony web-server by running following command:
```bash
bin/console server:start
```
To stop Symfony server simply use:
```bash
bin/console server:stop
```