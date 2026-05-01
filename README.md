# UserCore – Simple PHP CRUD with UI

A simple User Management CRUD application built with PHP, PDO, MySQL, and Bootstrap 5.

## Features
- Login / Logout with session management
- View all users in a responsive table
- Add new users
- Edit existing users
- Delete individual users or all users at once
- Flash messages for all actions (success, error, not found)

## Folder Structure
```
project/
├── components/
│   └── pdo.php         # Database connection
├── index.php           # Landing page
├── login.php           # Login page
├── logout.php          # Session destroy + redirect
├── auth.php            # Session guard (include on protected pages)
├── view.php            # List all users (protected)
├── add.php             # Add user form (protected)
├── update.php          # Edit user form (protected)
└── delete.php          # Delete handler (protected)
```

## Setup

1. Import the database schema:
```sql
CREATE DATABASE usermgmt;
USE usermgmt;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL
);
```

2. Update `components/pdo.php` with your database credentials if needed.

3. Place the project folder in your web server root (e.g., `htdocs` for XAMPP).

4. Open `http://localhost/project/index.php` in your browser.

## Requirements
- PHP 7.4+
- MySQL / MariaDB
- XAMPP / WAMP or any local server
"# Crud" 
