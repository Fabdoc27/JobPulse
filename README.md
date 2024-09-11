# Job Pulse

This project works with Laravel 10.x, PHP 8.1 or higher, and a MySQL database.

## Getting Started

Follow these steps to set up the project:

1. **Clone the repository and navigate to the directory:**

    ```shell
    git clone git@github.com:Fabdoc27/JobPulse.git
    cd JobPulse
    ```

2. **Install the dependencies:**

    ```shell
    composer install
    ```

3. **Create the environment file:**

    ```shell
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```shell
    php artisan key:generate
    ```

5. **Run the database migrations:**

    ```shell
    php artisan migrate
    ```

6. **Seed the database:**

    ```shell
    php artisan db:seed
    ```

7. **Start the development server:**

    ```shell
    php artisan serve
    ```
