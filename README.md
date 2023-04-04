Demo Fruityvice
========================

The "Demo Fruityvice" is a web application powered by Symfony as the backend and Vue.js as the frontend.

It has been develop following the [Symfony Best Practices][1].

Requirements
------------

  * PHP 8.1.0 or higher;
  * PDO-SQLite PHP extension enabled;
  * Composer;
  * NPM;
  * Vue.js 3.2.47 or higher;
  * and the [usual Symfony application requirements][2].

Installation
------------

There are 3 different ways of installing this project depending on your needs:

**Step 1.** [Download Composer][5] and use the `composer` binary installed
on your computer to run these commands:

```bash
# you can clone the code repository and install its dependencies
$ git clone https://github.com/ehsan-bahrami/fruityvice.git fruityvice
$ cd fruityvice/
$ composer install
```

**Step 2.** [Download Node.js][6] and use the `npm` to run these commands:

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

Usage
-----

**Step 1.** Run the application.

There are 2 different ways of running this application depending on your needs:

**Option 1.** [Download Symfony CLI][4] and run this command:

```bash
$ cd fruityvice/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

**Option 2.** Use a web server like Nginx or Apache to run the application
(read the documentation about [configuring a web server for Symfony][3]).

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

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/setup.html#technical-requirements
[3]: https://symfony.com/doc/current/setup/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://getcomposer.org/
[6]: https://nodejs.org/en/download