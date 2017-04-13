<p align="center">
    <img src="http://i.imgur.com/r0MreWz.png" width="250px">
</p>

# Context

Context is a really cool instant messaging app for schools. It is currently in development.

## How does it work?
Context is built upon the beautiful [Laravel](https://laravel.com) framework. It relies heavily upon the Laravel ecosystem to get things going.

Technologies included:
* [VueJS](http://vuejs.org)
* [Socket.IO](https://socket.io)
* [ESLint](http://eslint.org)
* [Laravel Echo](https://github.com/laravel/echo)
* [Laravel Passport](https://github.com/laravel/passport)

## How do I set it up?
This package primarily includes the code and install scripts. To get it setup follow these instructions:

### Prerequisites
* Apache or Nginx
* PHP 7.0 or higher
* Either, MySQL, MariaDB or Postgres
* Redis
* Node.JS
* Yarn
* Composer

### Setup
1. Git clone this repository in your web root
2. Copy `.env.example` to `.env` and change its contents to match your web server setup.
3. Call `composer install` from the command-line to install all required PHP packages.
4. Call `yarn install` from the command-line to install all required Node packages.
5. Call `npm run prod` to compile all views, Javascript and CSS.
6. Call `php artisan key:generate` and `php artisan optimize` to setup Laravel for operation.
7. Call `php artisan migrate` to setup your database for use with Context.
8. That's it! Have fun with your Context install.
