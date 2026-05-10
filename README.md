# 🏠 Workopia

Α modern, full-stack job board application built with Laravel 13, Inertia.js, and Vue.js. It is designed to provide a seamless experience for both employers looking to post vacancies and candidates searching for their next career move.

---

## 🚀 Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/John-Zevgolis/Workopia.git
cd Workopia
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Migration & Seeding

```bash
php artisan migrate --seed
```

### 5. Run the Application

```bash
php artisan serve
npm run dev
```

---

## 📋 Requirements

* PHP >= 8.x
* Composer
* Node.js & npm
* MySQL or SQLite

---

## ✨ Features

* Dynamic Job Listings: Browse and filter job opportunities in real-time with an intuitive interface.
* Employer Dashboard: A dedicated space for companies to create, manage, and track their job postings (Full CRUD functionality).
* Single-Page Experience: Powered by Inertia.js and Vue 3, ensuring lightning-fast navigation without page reloads.
* Email Notifications: Integrated SMTP support for automated transactional emails and notifications.
* Responsive Design: Fully optimized for mobile, tablet, and desktop using Tailwind CSS.
* Secure Authentication: Robust user registration and login system with protected routes.

---

## 📚 Disclaimer

This project was built as part of a Udemy course for learning purposes.
