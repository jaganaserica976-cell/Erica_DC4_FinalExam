# Student Grades Management System

A student grades management system with a Laravel backend and a React + Vite frontend.

## Project Structure

- `backend/` - Laravel application, controllers, models, routes, migrations, and Blade templates.
- `frontend/` - React + Vite student grades interface.

## Requirements

- PHP
- Composer
- MySQL or MariaDB
- Node.js and npm

## Run the React frontend

Open PowerShell in `frontend/` and run:

    npm install
    npm run dev

Open the local URL printed by Vite. For a production bundle, run `npm run build`.

The React interface includes demo views for Admin, Teacher, and Student roles and currently uses in-browser sample data. Role selection is for preview only, not authentication or secure access control. It is not connected to the Laravel database; the Laravel application continues to render its Blade pages separately.

## Run the Laravel application

Open PowerShell in `backend/` and run:

    composer install
    php artisan serve

Configure the database and environment variables before running migrations.

To create the sample Admin account, run this from `backend/` after configuring the database:

    php artisan db:seed

Then sign in at `/login` with `admin@example.com` and `Admin12345!`. Running the seeder again resets this sample account to that password.
