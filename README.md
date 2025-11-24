# 🐦 Pamitweet: Modern Social Media Application

*This is a test change to trigger a commit and push.*

## 📄 1. Project Overview

This project is a functional, full-stack social media application designed to replicate the core features of a micro-blogging service. The primary focus was on implementing clean code architecture, secure authentication, and a distinct, non-Twitter aesthetic. The final design utilizes a professional Deep Navy and Cream White theme.

**Developed by:** Arjay Pamittan

## ✨ 2. Features Implemented

### A. User Authentication & Security
* **Registration & Login:** User registration, login, and logout functionality are fully implemented.
* **Access Control:** All core interaction routes (posting, liking) are protected by middleware, requiring users to be authenticated.
* **Security:** Password hashing is handled securely by the Laravel framework.

### B. Post Management (CRUD)
* **Create Post:** A form exists to create new posts, with validation enforcing a maximum limit of 280 characters. A dynamic JavaScript counter is implemented.
* **Display:** Posts are displayed on the main feed, showing content, author, and timestamp, ordered by newest first.
* **Edit:** Users can edit their own posts, with the system showing an **(edited)** indicator if the content was modified.
* **Delete:** Users can delete their own posts, protected by authorization checks and requiring a confirmation prompt before deletion.

### C. Engagement & User Profile
* **Like System:** Users can like and unlike any post. A unique constraint is enforced in the database to prevent duplicate likes. A visual heart indicator changes state based on the current user's interaction.
* **Profile Page:** A dedicated profile view displays the user's name, join date, lists all their posts, and shows their total post count and total likes received.

## 🛠️ 3. Technology Stack & Design

| Category | Technology | Purpose |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 11 | Routing, Eloquent ORM, Blade Templating |
| **Database** | MySQL (via WAMPP) | Data storage for Users, Tweets, and Likes |
| **Authentication** | Laravel Breeze | Auth Scaffolding |
| **Frontend** | Bootstrap 5 & Custom CSS | UI components, Grid system, and non-flat, clean design |

## ⚙️ 4. Installation & Setup Guide

### Prerequisites
* WAMPP (or equivalent stack)
* Composer
* Node.js (LTS recommended)
* PHP (8.1+)

### A. Environment Setup
1.  **Clone/Download Project.**
2.  **Navigate to the project directory** and install PHP dependencies:
    ```bash
    composer install
    ```
3.  **Install Frontend dependencies:**
    ```bash
    npm install
    ```
4.  **Create `.env` file** by copying the example:
    ```bash
    cp .env.example .env
    ```

### B. Database Configuration
1.  Open **WAMPP / phpMyAdmin** and create a database named **`Pamitweet`**.
2.  Update the `.env` file with your credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=Pamitweet
    DB_USERNAME=root
    DB_PASSWORD=
    ```
3.  **Run Migrations:** Apply the database schema (Users, Tweets, Likes).
    ```bash
    php artisan migrate:fresh
    ```

### C. Running the Application
During local development, you need two terminals open:

1.  **Terminal 1 (Backend/PHP Server):**
    ```bash
    php artisan serve
    ```
    * *Access:* Navigate to `http://127.0.0.1:8000`.
2.  **Terminal 2 (Frontend/Asset Server):**
    ```bash
    npm run dev
    ```
    * *Note:* Keep this terminal running for the Bootstrap and custom CSS/JS to be loaded correctly.

---

## 🤝 5. Credits and Acknowledgements

This project utilized **Gemini 3 Pro** as a comprehensive development assistant for:
* Project planning, feature breakdown, and ensuring compliance with all core requirements.
* Generating clean, compliant Laravel code for core logic (Controllers, Models, Migrations).
* Debugging syntax and configuration errors (Vite/Mass Assignment/Syntax).
* Implementing and refining the custom Bootstrap UI/UX design to achieve the desired "unique and non-Twitter" aesthetic.

Created with Google Gemini Pro 3 Thinking