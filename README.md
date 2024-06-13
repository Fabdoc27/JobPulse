# Job Pulse

---

This project works with Laravel 10.x, PHP 8.1 or higher, and a MySQL database.

## Getting Started

It's super easy to setup.

First, clone the project and change the directory

```shell
git clone git@github.com:Fabdoc27/job_pulse.git
cd job_pulse
```

Then follow the process.

1. Install the dependencies

```shell
composer install
```

2. Copy `.env.example` to `.env`

```shell
cp .env.example .env
```

3. Generate application key

```shell
php artisan key:generate
```

4. Run the migration and seeders together

```shell
php artisan migrate:fresh --seed
```

5. Start the webserver

```shell
php artisan serve
```
