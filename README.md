
# WHAT'S THIS?

This is repository contains the api source code for Aimesoft test.

# INSTALLATION

## Requirement:

- Mysql >= 5.6 
- PHP >= 7.3
- phpunit >= 7.8

## Install dependencies via composer

```
composer install
```

## Start service
coppy .env file from .env.example and put your config on this file.


Then run
```
php artisan serve
```

##Seeding new User for login
run command
```
php artisan seed:user --email="youremail@gmail.com" --name="yourname" --password="yourpassword"
```
# CODING CONVENTIONS

- `PSR-2` for codding conventions
- `PSR-4` for auto-loading
