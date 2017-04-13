<p align="center">
    <img src="http://i.imgur.com/r0MreWz.png" width="400px">
</p>

Context is a really cool instant messaging app for schools. It is currently in development.

### How does it work?
Context is built upon the beautiful [Laravel](https://laravel.com) framework. It relies heavily upon the Laravel ecosystem to get things going.

Technologies included:
* [VueJS](http://vuejs.org)
* [Socket.IO](https://socket.io)
* [ESLint](http://eslint.org)
* [Laravel Echo](https://github.com/laravel/echo)
* [Laravel Passport](https://github.com/laravel/passport)

# How do I set it up?
This package primarily includes the code and install scripts. It is recommended to start a virtual server over at DigitalOcean or Linode and setup from there.

## Prerequisites
* Apache or Nginx
* PHP 7.0 or higher
    * php-mbstring
    * php-zip
    * php-dom
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
6. Call `./node_modules/.bin/laravel-echo-server init` to setup the Websockets server
7. Call `php artisan key:generate`, `php artisan optimize` and `php artisan passport:install` to setup Laravel for operation.
8. Call `php artisan migrate` to setup your database for use with Context.
9. That's it! Have fun with your Context install.

## Running the Laravel Echo server
In order for the server to be able to send push notifications, we need the Laravel Echo server to be running. The server can be started by ruunning `./node_modules/.bin/laravel-echo-server start`.

However, to run this command as the logged in user is just bad practice. So to make sure the server start with the system, we use Forever:

1. Install forever by calling `yarn global add forever`
2. Call `forever start ./node_modules/.bin/laravel-echo-server start`
