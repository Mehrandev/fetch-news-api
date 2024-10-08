# Laravel Project Docker Setup

## Project Setup Guide

### Prerequisites
Make sure you have the following installed on your machine:
- **Docker**: [Download and install Docker](https://docs.docker.com/get-docker/)
- **Docker Compose**: Docker Compose is included with the latest version of Docker Desktop

### Getting Started
Follow the steps below to set up the project from scratch using Docker.

---

### Step 1: **Clone the Repository**

Clone this repository to your local machine:

```bash
git clone <repository_url>
cd <project_directory>
```

Replace `<repository_url>` with the URL of your repository and `<project_directory>` with the directory name.

---

### Step 2: **Set Up the Environment Variables**

Create a `.env` file in the root directory and configure it based on the example provided below:

```ini
# Laravel Environment
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:ZOdAl4+8/7zckLo+dTi1bGZKZwBFGtHvl9CF7aliz3I=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel_user
DB_PASSWORD=secret
NEWSAPI_KEY=d1fb2e97cec44005aa9e279ddea37f51

```

If you already have an `.env.example` file, you can create `.env` using:

```bash
cp .env.example .env
```

### Step 3: **Build and Start the Docker Containers**

Run the following command to build and start the Docker containers:

```bash
docker-compose up --build -d
```

- `--build`: Forces the Docker build process.
- `-d`: Runs the containers in detached mode (in the background).

This command will start the following containers:
- **app**: The Laravel application using the built-in server.
- **db**: MySQL database service.

### Step 4: **Install Laravel Dependencies**

Once the containers are up and running, access the `app` container to install the Laravel dependencies:

```bash
docker-compose exec app composer install
```

### Step 5: **Generate Application Key**

Generate a new application key for the Laravel application:

```bash
docker-compose exec app php artisan key:generate
```

### Step 6: **Run Database Migrations**

Run the database migrations to create the necessary tables:

```bash
docker-compose exec app php artisan migrate
```

### Step 7: **Seed the Database**

Seed the database with initial data:

```bash
docker-compose exec app php artisan db:seed
```

### Step 8: **Access the Application**

After completing the above steps, you can access the application in your browser at:

```
http://127.0.0.1:8000
```

### Step 9: **Access the MySQL Database**

You can access the MySQL database using any MySQL client (e.g., MySQL Workbench, DBeaver, or TablePlus) using the following credentials:

- **Host**: `127.0.0.1`
- **Port**: `3306`
- **Username**: `laravel_user`
- **Password**: `secret`
- **Database Name**: `laravel`

### Step 10: **Stop the Docker Containers**

To stop the containers, run the following command:

```bash
docker-compose down
```

### Step 11: **Run swagger documentation**

To generate swagger documentation run :

```bash
docker-compose exec app php artisan l5-swagger:generate
```

### Step 11: **Run test**

To run tests , run :

```bash
docker-compose exec app php artisan test
```

---

### Troubleshooting

- **Permission Issues**:
  If you encounter permission issues with the `storage` or `bootstrap/cache` directories, run the following command:

  ```bash
  docker-compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
  ```

- **Database Connection Error**:
  Ensure that the `DB_HOST` in your `.env` file is set to `db` (the name of the database service in `docker-compose.yml`).

---

### Folder Structure

The project folder structure should look like this:

```
├── app/
├── bootstrap/
├── config/
├── database/
├── docker/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .env
├── Dockerfile
├── docker-compose.yml
└── README.md
```

---

### Customizing the Setup

If you need to customize the Docker setup (e.g., change MySQL version or PHP extensions), you can modify the following files:

1. **Dockerfile**: Customize PHP version and extensions.
2. **docker-compose.yml**: Modify the services and environment variables.
3. **.env**: Configure Laravel environment and database settings.

---

### Additional Commands

- **Rebuild Docker Images**:
  If you make changes to the `Dockerfile` or `docker-compose.yml`, rebuild the images:

  ```bash
  docker-compose build
  ```

- **Check Logs**:
  To view the logs for any service, use:

  ```bash
  docker-compose logs app
  docker-compose logs db
  ```

- **Run Artisan Commands**:
  Run Laravel Artisan commands directly in the `app` container:

  ```bash
  docker-compose exec app php artisan <command>
  ```

---

---
- **Fetching data**:
    After 1 minute you should be able to see data being fetched and store in database

### Conclusion

With these steps, you should be able to run the project from scratch using Docker. If you encounter any issues, please refer to the


### Important notes about the project : 

## Project Notes and Future Improvements

### 1. **General Laravel Project Structure**
- Separate requests, responses, and controllers into dedicated folders for each module.
- Implement standardized response contracts for error and success responses to ensure consistent API output.
- Use the **Factory Pattern** for creating complex objects to follow the SOLID principles and enhance code modularity.
- **Rate Limiting**: Consider implementing rate limiting for creating or updating user personalization settings to prevent abuse.

### 2. **Testing Strategy**
- Expand unit tests to cover all parts of the codebase, including services, repositories, and controllers.
- Implement feature tests for critical paths such as article listings, user authentication, and personalized settings.
- Cover all types of errors for endpoints to ensure robust validation and error handling.

### 3. **Swagger Documentation**
- Expand Swagger to cover all API endpoints, including request and response schemas.
- Use a modular structure for Swagger documentation, separating schemas from controllers to reduce clutter.

### 4. **Database Optimization**
- Implement **unique identifiers** for each article based on the source to prevent storing duplicate articles in the database.
- Use database indexes on frequently queried fields (e.g., `title`, `category_id`, `source_id`) to improve search performance.
- Use separate repositories for caching and database interactions to keep the service layer clean.

### 5. **Future Architectural Improvements**
- **Microservices Architecture**: Split the project into smaller services:
    - **Fetching Service**: Responsible for crawling and fetching articles from external sources and adding them to the database.
    - **User Service**: Manages user-specific settings and serves articles based on user preferences.
    - Use a message queue (e.g., RabbitMQ) for communication between services.

### 6. **Additional Enhancements**
- Implement a **caching layer** for commonly accessed endpoints to reduce database load and improve response times.
- Introduce a separate `ArticleCacheRepository` for managing caching logic independently of business logic.
- We can add more rate limits and customize them based on our need.
- Add more exceptions and catch errors, so we can log them somewhere for investigation.
- 
### 7. **Security Considerations**
- Implement checks for XSS and other potential security vulnerabilities when handling data from external sources.
- Sanitize all incoming data before storing it in the database to prevent malicious input.

### 8. **Versioning and Scalability**
- Use a well-defined versioning strategy for API endpoints (e.g., `V1`, `V2`) to manage breaking changes and provide backward compatibility.
- Modularize the codebase to allow for easy addition of new modules and features in the future.

