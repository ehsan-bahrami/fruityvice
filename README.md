Demo Fruityvice
========================

The "Demo Fruityvice" is a web application powered by Symfony as the backend and Vue.js as the frontend.

It fetches data from [Fruityvice][1], displays them in a data table, filters them and can create a favourite list of fruits.

It has been develop following the [Symfony Best Practices][2].

Features
------------

  * The Symfony PHP framework for the backend and VueJS 3 for the frontend
  * A page with all fruits (paginated)
  * A form to filter fruits by all fields
  * Each fruit can be added to favorites (up to 10 fruits)
  * A page with favorite fruits
  * Display all nutrition facts for all fruits
  * Installation and startup instructions
  * Tests
  * In php follow PSR-12
  * In JS follow JavaScript Standard Style
  * TypeScript

Requirements
------------

  * PHP 8.1.0 or higher;
  * PDO-SQLite PHP extension enabled;
  * Composer;
  * NPM;
  * Vue.js 3.2.47 or higher;
  * and the [usual Symfony application requirements][3].

Installation
------------

There are 3 different ways of installing this project depending on your needs:

**Step 1.** [Download Composer][6] and use the `composer` binary installed
on your computer to run these commands:

```bash
# you can clone the code repository and install its dependencies
$ git clone https://github.com/ehsan-bahrami/fruityvice.git fruityvice
$ cd fruityvice/
$ composer install
```

**Step 2.** [Download Node.js][7] and use the `npm` to run these commands:

```bash
# you can run this command
$ npm run watch

# ...or you can run this one
$ npm run build
```

**Step 3.** Change DATABASE_URL's value in .env file with your database credentials then run these commands:

```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
```

**Step 4 (optional).** Change "MAILER_DSN" environment variable for enabling the email. Then uncomment line 44 (// $this->sendEmail();) in src\Command\FruitsFetchCommand.php file.


Usage
-----

**Step 1.** Run the application.

There are 2 different ways of running this application depending on your needs:

**Option 1.** [Download Symfony CLI][5] and run this command:

```bash
$ cd fruityvice/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

**Option 2.** Use a web server like Nginx or Apache to run the application
(read the documentation about [configuring a web server for Symfony][4]).

On your local machine, you can run this command to use the built-in PHP web server:

```bash
$ cd fruityvice/
$ php -S localhost:8000 -t public/
```

**Step 2.** Run the below command and fetch Fruityvice data from the API.

```bash
$ php bin/console fruits:fetch
```

Tests
-----

Execute this command to run tests:

```bash
$ cd fruityvice/
$ ./bin/phpunit
```

Screenshots
------------

Home page
![homePage](https://user-images.githubusercontent.com/106521330/230403035-b97f95f7-89f5-4e15-9850-5830ac924303.jpg)
All fruits
![allFruits](https://user-images.githubusercontent.com/106521330/230403075-be817422-05ca-4230-a3e5-4cc1d0b437af.jpg)
Favorite fruits
![favoriteFruits](https://user-images.githubusercontent.com/106521330/230403119-bb9fdbe5-559d-4513-90ec-53b318a62ad2.jpg)
Up to ten limitation
![upToTenLimitation](https://user-images.githubusercontent.com/106521330/230403169-47ff7369-0737-4774-94df-76c16f3fdc9b.jpg)

[1]: https://fruityvice.com/
[2]: https://symfony.com/doc/current/best_practices.html
[3]: https://symfony.com/doc/current/setup.html#technical-requirements
[4]: https://symfony.com/doc/current/setup/web_server_configuration.html
[5]: https://symfony.com/download
[6]: https://getcomposer.org/
[7]: https://nodejs.org/en/download