 
# Corvus Inventory Management System

Start to manage purchases, orders and inventory in your own server. Intellect developed by power of Laravel and PHP.

## Table of Contents

- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Run](#run)
- [Documentation](#documentation)
- [Bugs and Feedback](#bugs-and-feedback)
- [License](#license)

## Features
-   Inventory Management
-   Real-time inventory control
-   API Gateway
-   Pricing Management
-   Data Import/Export Tools
-   Reporting Service
-   Customer Portal
-   Data Mapping


## System Requirements
To be able to run Laravel Boilerplate you have to meet the following requirements:
- PHP > 7.1
- PHP Extensions: PDO, cURL, Mbstring, Tokenizer, Mcrypt, XML, GD
- Node.js > 6.0
- Composer > 1.0.0

## Installation
1. Install Composer using detailed installation instructions [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
```
$ wget https://getcomposer.org/composer.phar
$ chmod +x composer.phar
$ mv composer.phar /usr/local/bin/composer
```
2. Install Node.js using detailed installation instructions [here](https://nodejs.org/en/download/package-manager/)
```
$ yum install npm
```
3. Clone repository
```
$ git clone https://github.com/gazatem/corvus.git
```
4. Change into the working directory
```
$ cd intellect
```
5. Copy `.env.example` to `.env` and modify according to your environment
```
$ cp .env.example .env
```
6. Install composer dependencies
```
$ composer install --prefer-dist
```
7. An application key can be generated with the command
```
$ php artisan key:generate
```
8. Execute following commands to install other dependencies
```
$ npm install
$ npm run dev
```
9. Run these commands to create the tables within the defined database and populate seed data
```
$ php artisan migrate --seed
```


## Run

To start the PHP built-in server
```
$ php artisan serve --port=8080
or
$ php -S localhost:8080 -t public/
```

Now, you may login to your system using following credentials.

```
Username: admin@gazatem.com

Password: admin
```

Now you can browse the site at [http://localhost:8080](http://localhost:8080)  


## Documentation

Check out project [support](https://gazatem.com/support) pages for modules configuration and troubleshooting.
For more detailed instructions on how to use Laravel and it's extensions, check out the full Laravel [documentation](https://laravel.com/docs/).



## Bugs and Feedback

For bugs, questions and discussions please use the [contact form](https://gazatem.com/contact-us).

## License

This boilerplate is open-sourced software licensed under the [MIT license](LICENSE).
