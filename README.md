# TLG App

## Assessment Instructions

The following is a Laravel 8+ application that demonstrates your ability to develop a simple CRUD
interface with the following features::

1. Authentication via any method, e.g., Breeze, Jetstream, etc., (must have front-end and not just API authentication, such as Sanctum, etc.)
2. Migration scripts for database schema, factory and seed classes (fake or sample data). This could be based on any CRUD application you build, such as a Blog, Movie Database, Todo app, etc. NOTE: You must have more than 1 model and establish a relationship between the models both at the database and code level, e.g., schema and model classes, e.g.,(posts, comments, etc.)
3. Develop CRUD (create, read, update and delete) interface behind authentication and corresponding Blade views. NOTE: Be creative yet think through what elements of a CRUD interface may be useful, e.g., which columns to display, pagination, column sorting, filtering, searching, number of records to display, etc.
4. Must implement form validation (could be front-end, server-side, both, etc.) using any format and technology / approach you wish, which could be done via JavaScript, VueJS, React, Livewire, etc., etc.
5. Your application must send a transactional email as well using any SMTP provider, such as MailHog, MailTrap, Helo App by Beyond Code, SendGrid, Mailgun, etc., when a record is created.

## Build Directions

So you have downloaded the repository, what next?

Well the following instructions assume you have local access to PHP, composer and docker/sail. If you have these
applications then open up your favorite terminal and navigate to the application base directory.

We can now use composer to install our dependencies.

```shell
composer install
```

Fire up the sail application.

```shell
./vendor/bin/sail up -d
```

The application should now load in the browser at `http://localhost`.


### Assessment Item One [Authentication]

Breeze has been added via composer, so we only need to install the assets.

```shell
./vendor/bin/sail artisan breeze:install
```

You should receive a message that the scaffolding was installed successfully. Now install node package using npm.

```shell
./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev
```

Now reload your application in the browser (http://localhost) and you should now see two new links in the upper right corner of the default application page (Log in and Register)

We can view all the Breeze authentication routes by looking at `routes/auth.php`. This provides us a listing of the controllers used.

## Assessment Item Two [Migration]

Let's migrate our default project data along with our actor and movie data into database tables. 
NOTE: The seeders for actor and movies are using large json files to migrate data. They also are generating the 
necessary relationship based on the data in the json file. To avoid a long migration, you can drop the `--seed` and use 
the `*.sql` files found in `database/data`and import data directly into the DB to avoid the LONG 
seeding process.

```shell
./vendor/bin/sail artisan migrate <--seed>
```

## Assessment Item Three [CRUD]

Once the application data has been migrated, login to the application using the following credentials:

```shell
email: admin@localhost
password: password
```

Here you can choose either Movies or Actors. The data should paginate via simple pagination.

Here you can edit or delete the records using the associated links in the list of movies or actors.

## Assessment Item Four [Validation]

The backend is validating the request data using spatie/laravel-data.

TODO: Add front-end validation notifications

## Assessment Item Five [Notifications]

Anytime a new actor or movie record is added, the application will send an email notification to the user with details 
about the record added.

You can view the email by navigating to [http://localhost:8025/](http://localhost:8025/)

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
