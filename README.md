# ✨ Ivory Glow Salon System ✨

![Laravel](https://img.shields.io/badge/Laravel-8.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1-blue?style=for-the-badge&logo=php)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=for-the-badge&logo=bootstrap)
![MySQL](https://img.shields.io/badge/MySQL-dblue?style=for-the-badge&logo=mysql)
![GitHub](https://img.shields.io/badge/GitHub-repo-black?style=for-the-badge&logo=github)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

---

## 💎 Overview
**Ivory Glow Salon System** is a luxurious and user-friendly web application built to streamline salon management and enhance customer experience.  
It supports three roles: **Admin**, **Staff**, and **Customer**, allowing smooth management of appointments, services, inventory, and more.

Built with:  
**Laravel | Bootstrap 5.3 | Animate.css | AOS | Font Awesome | Hover.css | SweetAlert2 | jsPDF**  

---

## 📌 Table of Contents
- [Features](#features)  
- [User Roles](#user-roles)  
  - [Admin](#admin)  
  - [Customer](#customer)  
  - [Staff](#staff)  
- [Technologies Used](#technologies-used)  
- [Installation](#installation)  
- [Usage](#usage)  
- [Screenshots](#screenshots)  
- [Contributing](#contributing)  
- [License](#license)  

---

## 🌟 Features
- **Role-Based Access:** Admin, Staff, and Customer dashboards.  
- **Responsive Design:** Works perfectly on desktop & mobile with glassmorphism effects.  
- **Appointment Management:** Book, approve, cancel with conflict detection.  
- **Inventory Control:** Admin manages products and stock levels.  
- **Invoice Generation:** Customers download PDF invoices.  
- **Reports:** Admin generates detailed service/staff/time reports.  
- **Feedback System:** Customers send feedback; Admin views it.  
- **Shop Customization:** Update salon info & social media links.  

---

## 🧑‍💼 User Roles

### Admin
- **Login:** Top-right dropdown → Admin Login  
  - Email: `admin@gmail.com`  
  - Password: `123`  
- **Dashboard:** Total staff/customers, earnings, appointment statuses, low-stock alerts  
- **Staff Management:** Add/update/delete staff profiles  
- **Service Management:** Add/update/delete services  
- **Inventory:** Track stock, assign products to staff categories  
- **Customer Management:** View details & bookings  
- **Reports & Feedback:** Generate reports and view feedback  
- **Shop Settings:** Update salon details  

### Customer
- **Register/Login:** Create account to book services  
- **Book Appointment:** Select date/time with conflict detection  
- **My Settings:** View personal details, bookings, invoices  
- **Cancel Booking:** Cancel pending or confirmed bookings  

### Staff
- **Login:** Staff Login dropdown  
- **Dashboard:** Daily appointments, notifications, total handled  
- **Manage Appointments:** Approve/update appointments, select products used  
- **Customer Interaction:** View assigned customer details  
- **Profile:** Update personal info  

---

## 🛠 Technologies Used
**Backend:** Laravel (PHP)  
**Frontend:**  
- Bootstrap 5.3  
- Animate.css  
- AOS (Animate on Scroll)  
- Font Awesome  
- Hover.css  
- SweetAlert2  

**PDF:** jsPDF, jsPDF-AutoTable  
**Database:** MySQL  
**Styling:** Glassmorphism effects, color palette: `#8b5a2b`, `#f5f5f5`, `#3c2f2f`, `#d4a373`  
**Fonts:** Playfair Display (headings), Montserrat (body)  

---

## ⚙️ Installation

**Prerequisites:**  
- PHP >= 8.1  
- Composer  
- Node.js & npm  
- MySQL  
- Git  

**Steps:**
```bash
# Clone the repository
git clone https://github.com/your-username/ivory-glow-salon-system.git
cd ivory-glow-salon-system

# Install dependencies
composer install
npm install
npm run build

# Set up environment
cp .env.example .env
# Update DB credentials

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed

# Set up storage
php artisan storage:link

# Start server
php artisan serve
