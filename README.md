# 🖼️ PixelKit — Image Optimizer

> Fast, simple and reliable image optimization for the modern web.

## 📌 About PixelKit

**PixelKit** is a full-stack image optimization web application built with Laravel. It allows users to **compress, resize, and convert images** through a simple and responsive interface.

The project was built to implement real-world backend concepts such as authentication, authorization, file handling, image processing, database management, and admin functionality.

### ✨ Key Features

* 🗜️ Image compression
* 📐 Image resizing
* 🔄 Image format conversion
* 🔐 User authentication
* 👤 User dashboard
* 👨‍💼 Admin dashboard
* 📊 Image optimization history
* 🧹 Temporary image processing
* 📱 Responsive UI
* 🚀 Production deployment

---

## 🛠️ Tech Stack

```text
PHP
Laravel 12
MySQL
Blade
Bootstrap
JavaScript
Vite
Image Processing
```

---

## 🔄 How It Works

```text
Upload Image
      ↓
Validate Image
      ↓
Process Image
      ↓
Compress / Resize / Convert
      ↓
Save Optimization Details
      ↓
Download Optimized Image
      ↓
Temporary File Cleanup
```

---

## 🏗️ Architecture

PixelKit follows Laravel's MVC architecture with a dedicated image optimization service.

```text
User
 ↓
Routes
 ↓
Controller
 ↓
Image Optimization Service
 ↓
Image Processing
 ↓
MySQL + Temporary Storage
```

---

## 🔐 Authentication & Authorization

PixelKit supports separate user and admin functionality.

**Users can:**

* Register and login
* Process images
* Download optimized images
* View optimization history

**Admins can:**

* Access the admin dashboard
* Monitor application activity
* Manage administrative functionality

---

## 🚀 Installation

### Clone the project

```bash
git clone https://github.com/YOUR_USERNAME/pixelkit.git
cd pixelkit
```

### Install dependencies

```bash
composer install
npm install
```

### Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Configure your MySQL database in `.env`.

### Run migrations

```bash
php artisan migrate
```

### Build frontend

```bash
npm run build
```

### Start the application

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

---

## 👨‍💻 Developer

**Saurabh Nath**

PixelKit is an independently developed project built and maintained by me.

### Technologies & Focus

```text
PHP
Laravel
MySQL
JavaScript
Bootstrap
Vite
Image Processing
Backend Development
```

---

## 📌 Project Status

PixelKit is an actively developed personal project.

The current version includes:

* Image compression
* Image resizing
* Image conversion
* User authentication
* User dashboard
* Admin dashboard
* Optimization history
* Temporary image processing
* Responsive UI
* Production deployment support

---

## 🔒 Ownership

© 2026 Saurabh Nath. All rights reserved.

PixelKit is a personal project. The source code is not licensed for redistribution, resale, or commercial reuse without permission from the developer.
