# Task Management System

This is a full-stack Task Management system built using Laravel and Vue.js. The application features a REST API for task management, utilizing Laravel Sanctum for API authentication and Laravel Breeze for handling user authentication. Tailwind CSS is used for styling.

## Features

- User authentication with Laravel Breeze
- API authentication with Laravel Sanctum
- Task creation, reading, updating, and deletion
- Responsive design with Tailwind CSS

## Tech Stack

- **Backend:** Laravel
- **Frontend:** Vue.js
- **Authentication:** Laravel Sanctum, Laravel Breeze
- **Styling:** Tailwind CSS

## Installation

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js and npm
- MySQL or any other database

### Steps

1. Clone the repository:

```sh
git clone https://github.com/yourusername/task-management-system.git
cd task-management-system
```
2. Install dependencies

```sh
composer install
```

```sh
npm install
```
3. Create a copy of .env file

```sh
cp .env.example .env
```
4. Generate application key
```sh
php artisan key:generate
```
5. Configue Database in .env file
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
6. Run database migrations
```sh
php artisan migrate
```
7. Seed th database
This file the 'roles' table with initial values
```sh
php artisan db:seed
```
8. Starts development servers
To start the backend server, run the following in a terminal
```sh
php artisan serve
```
On a new terminal window/tab, run the following to compile the frontend assets
```sh
npm run dev
```

# API ENDPOINTS
The API follows RESTful principles. Below are the available endpoints:
## Authentication
      - Login: 'POST /api/login'
      - Logout: 'POST /api/logout'
## Tasks
      - get all tasks: 'GET /api/tasks'
      - get one task: 'GET /api/task/{id}'
      - get completed tasks: 'GET /api/tasks/completed'
      - get pending tasks: 'GET /api/tasks/pending'
      - get overdue tasks: 'GET /api/tasks/overdue'
      - create task: 'POST /api/task/create'
      - delete task: 'DELETE /api/task/delete/{id}'
      - update task: 'PUT /api/update/{id}'
## Usage
The API endpoint can be tested using postman. When you login using the API login route, an access token is issued. To interact with the API, you will need to include the Authorization header with your token in each request.
i.e. 'Authorization': 'Bearer {accessToken}'
