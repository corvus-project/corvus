# Intellect Inventory System

Modular Inventory and CRM for ant sized companies with open source code. Developed based on [Laravel Boilerplate](https://github.com/rappasoft/laravel-boilerplate)

## Table of Contents

- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Run](#run)
- [Docker](#docker) :point_left:
- [Bugs and Feedback](#bugs-and-feedback)
- [License](#license)

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
$ git clone https://github.com/gazatem/intellect.git
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

## Troubleshooting

- If you get an error like a `PDOException` try editing your `.env` file and change `DB_HOST=127.0.0.1` to `DB_HOST=localhost` or `DB_HOST=mysql` (for *docker-compose* environment).

- If you get a password error try this command:
```
# ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root'; 
```

## Run

To start the PHP built-in server
```
$ php artisan serve --port=8080
or
$ php -S localhost:8080 -t public/
```

Now you can browse the site at [http://localhost:8080](http://localhost:8080)  🙌

## Docker

Here is a Docker based local development environment prepared, which provides a very flexible and extensible way of building your custom Laravel applications.
 
### Run

1. Clone repository
```
$ git clone https://github.com/gazatem/intellect.git
```

2. Copy `.env.example` to `.env` and modify according to your environment (make sure database host set to `DB_HOST=mysql`)
```
$ cp .env.example .env
```

3. Start environment
```
$ docker-compose up -d  # to start base containers
or
$ docker-compose -f docker-compose.yml -f docker-compose.utils.yml up -d  # to start base and utils containers
```

4. Build project
```
$ docker exec laravel-boilerplate_laravel-env_1 ./dockerfiles/bin/prj-build.sh
 or
$ docker-compose run --rm laravel-boilerplate_laravel-env_1 ./dockerfiles/bin/prj-build.sh
```

Now you can browse the site at [http://localhost:80](http://localhost:80)  🙌

---

5. Stop environment
```
$ docker-compose down
 or
$ docker-compose -f docker-compose.yml -f docker-compose.utils.yml down
```
  
 

## Bugs and Feedback

For bugs, questions and discussions please use the [GitHub Issues](https://github.com/gazatem/intellect/issues).

## License

This boilerplate is open-sourced software licensed under the [MIT license](LICENSE).
