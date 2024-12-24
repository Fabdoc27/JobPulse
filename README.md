# Jobpulse

Jobpulse is a comprehensive job board platform tailored for job seekers and recruiters. It empowers users with job management, role-specific dashboards, and dynamic plugin integration while offering robust content management features. This ensures a seamless and customizable experience for owners, companies, and candidates.

## Features

-   **Role-Based Access Control**: Distinct dashboards and functionalities for Owners, Companies, and Candidates.
-   **Job Management**: Full CRUD operations for job listings with detailed applicant information.
-   **Company Profiles**: Manage company details with status updates and plugin integration for added functionalities.
-   **Candidate Profiles**: Dynamically manage resumes, work experiences, and education history.
-   **Dynamic Plugins**: Owners can create, update, or delete plugins; companies can activate or deactivate them to suit their needs.
-   **Page Management**: Owners can create, update, and manage content for blogs and other key pages such as About Us, Contact Us, and the landing page.

## Getting Started

Follow these steps to set up the project locally.

### Installation

1. **Clone the repository:**

    ```shell
    git clone git@github.com:Fabdoc27/JobPulse.git
    ```

2. **Navigate to the project directory:**

    ```shell
    cd JobPulse
    ```

3. **Install PHP dependencies:**

    ```shell
    composer install
    ```

4. **Create the environment file:**

    ```shell
    cp .env.example .env
    ```

5. **Generate the application key:**

    ```shell
    php artisan key:generate
    ```

6. **Run database migrations:**

    ```shell
    php artisan migrate
    ```

7. **Seed the database:**

    ```shell
    php artisan db:seed
    ```

8. **Start the local development server:**

    ```shell
    php artisan serve
    ```
