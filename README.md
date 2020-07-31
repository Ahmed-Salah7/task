## About Laravel Simple Task

 
 
 ## This is a Laravel Task
 
  - roles-permissions management based on [https://github.com/spatie/laravel-permission v3].
 
 - multi guard auth ( admin have  [role & permission] , user).
 
 - manage media based on [https://github.com/spatie/laravel-medialibrary v7].
 
 - command to clear cache then install project  (config,cache,view,composer dumpautoload,migrating,seeding...etc ).
 
 - designed based on [https://github.com/ColorlibHQ/AdminLTE/ v3].
 
 - CRUD ( Administrations , Users , Role , Permission ).
 

## Installation, and Usage Instructions

``` bash
composer install

cp .env.example .env (then config DB_CONNECTION , APP_URL)

php artisan key:generate

php artisan project:install

php artisan storage:link

npm install

npm run dev

php artisan serve
admin : http://localhost:8000/admin/login    admin@gmail.com password
admin : http://localhost:8000/login    user@gmail.com password

```
## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Ahmed Salah via [ahmed.salah.fcih@gmail.com](mailto:ahmed.salah.fcih@gmail.com). All security vulnerabilities will be promptly addressed.


## License
 
