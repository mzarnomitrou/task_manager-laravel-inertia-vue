# Task Manager exercise using Laravel and Inertia Vue

## About Project
This is a simple task manager application that allows the users to review their projects and perform basic CRUD functions on the tasks related to the project.

## Key techniologies
- **Laravel** (PHP Framework) for building the backend API and handling business logic.
- **Inertia.js** for seamless communication between the backend and frontend without the need for a
     traditional API.
- **Vue.js** for building interactive and reactive user interfaces.


### Prerequisites
- PHP >= 8.0
- Composer (for PHP dependencies)
- Node.js v22.21.1
- NPM (for managing front-end dependencies)

Before running the project, make sure you have **Docker** and **Docker Compose** installed:

1. **Docker**: Download from [docker.com](https://www.docker.com/get-started).
2. **Docker Compose**: Typically comes bundled with Docker. Verify by running:
   ```bash
   docker-compose --version

### Steps to Run the Application Locally

1. Clone Repository 
    git clone https://github.com/mzarnomitrou/task_manager-laravel-inertia-vue.git
    cd task_manager-laravel-inertia-vue

2. Start docker containers
    docker-compose up --build

3. Run npm install --force for dependecies
     (Note: There are currently 2 vulnerability issues during npm install that should be resolved in the future.)

4. Run npm run dev for front-end server

5. Run database migrations
    docker-compose exec app php artisan migrate

6. Run database seeder
    docker-compose exec app php artisan db:seed 
    Regarding the seeders it creates a user with email admin@example.com with password: password. To facilitate demo purposes. 

7. Access the App
    Open your browser and navigate to http://localhost to view the application.


#### Notes and Improvement ####

    1. Project Page Refresh Issue: The project page is not refreshing after any CRUD operations. This needs to be fixed to ensure the page updates after tasks are modified.
    2. Pagination for tasks should be implemented/ was not working correctly. 
    3. Flash Messages: Flash messages should be implemented to notify users of successful CRUD operations (e.g., task creation, updates, deletions).
    4. User Tasks & Project Management: The "My Tasks" page for authenticated users and the ability to add/edit projects should be implemented in future versions.





