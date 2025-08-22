Ivory Glow Salon System

Welcome to Ivory Glow Salon System, a sophisticated and user-friendly web application built to streamline salon management and enhance customer experience. Designed with a luxurious aesthetic, this system caters to three distinct user roles—Admin, Staff, and Customers—offering a seamless interface for managing appointments, services, inventory, and more. Powered by Laravel, Bootstrap 5.3, Animate.css, AOS, Font Awesome, Hover.css, SweetAlert2, and jsPDF, Ivory Glow combines elegance with functionality.
Table of Contents

Features
User Roles and Functionality
Admin
Customer
Staff


Technologies Used
Installation
Usage
Screenshots
Contributing
License
Contact

Features

Role-Based Access: Tailored dashboards and functionalities for Admin, Staff, and Customers.
Responsive Design: Fully responsive interface with smooth animations and glassmorphism effects, optimized for all devices.
Appointment Management: Easy booking, status updates, and cancellation with conflict detection.
Inventory Control: Admin can manage products, track stock levels, and update quantities.
Invoice Generation: Customers can view and download PDF invoices for completed bookings.
Reports: Admin can generate and download detailed reports by service, staff, or time period.
Feedback System: Customers can send feedback via the contact page, viewable by Admin.
Shop Customization: Admin can update salon details, including social media links and operating hours.

User Roles and Functionality
Admin
The Admin role provides full control over the salon system, ensuring efficient management of staff, services, inventory, and customer interactions.

Login: Access via the top-right dropdown menu (select "Admin Login") on the homepage. Use:
Email: admin@gmail.com
Password: 123


Dashboard: View key metrics:
Total staff and customers.
Current month’s total earnings.
Appointment statuses (pending, confirmed, completed, cancelled).
Low-stock product alerts.
Update email and password via the "My Settings" button.


Add Staff: Create staff profiles with:
Name, Email, Password, Phone, Position, Working Days (Mon-Sun), Profile Picture.
Update or delete staff profiles.


Add Service: Create services by:
Selecting a staff member based on their position.
Specifying service name, duration, description, price, and image.
Update or delete services.


Inventory: Manage products with:
Product Name, Category (based on staff position), Quantity, Unit Price, Unit (ml, g).
Assign products to staff categories.
Update quantities for low-stock items or delete products.


Customers: View registered customers’ details and their booking history.
Reports: Generate downloadable reports by:
Service, Staff, or time period (days, weeks, months).
Identify top-performing services and staff.


Messages: View customer feedback submitted via the contact page.
Shop: Update salon details:
Social media links, address, phone number, location, operating hours.



Customer
The Customer role allows users to explore services, book appointments, and manage their profiles with a luxurious and intuitive interface.

Home: The landing page showcases:
About Us, Available Services, Staff Profiles, and Contact Form.
Login required to book services.


Book Appointment:
Select a date based on the staff’s availability for the chosen service.
Choose a time slot, with conflict detection to prevent double bookings.
Receive a message if the selected time is already booked.


Register: Create an account with:
Name, Email, Phone Number, NIC, Password, Address.


Login: Access the system with registered email and password.
Home (Post-Login): Displays "My Settings" and "Logout" buttons, replacing Register/Login.
My Settings:
View personal details (Name, Email, Phone).
Review bookings, statuses, and completed booking invoices (downloadable as PDFs).
Cancel pending or confirmed bookings.


Logout: Returns to the public homepage.

Staff
The Staff role enables employees to manage their appointments and customer interactions efficiently.

Login: Access via the top-right dropdown menu (select "Staff Login") on the homepage. Use the provided email and password.
Dashboard: View:
Current day’s appointments.
Total appointments handled.
New appointment notifications.
Working days (Mon-Sun).


Appointment Manager:
Update appointment statuses (e.g., approve pending appointments).
Select products used for approved appointments or mark them as completed.


Customer Interaction: View details of customers assigned to their appointments.
Profile: Update personal details (Name, Email, Phone, etc.).
Logout: Returns to the public homepage.

Technologies Used

Backend: Laravel (PHP framework for robust backend logic and database management).
Frontend:
Bootstrap 5.3: For responsive layouts, modals, and components.
Animate.css: For entrance animations (e.g., fadeInLeft, fadeInUp).
AOS (Animate on Scroll): For scroll-based animations.
Font Awesome: For icons (e.g., spa logo, social media icons).
Hover.css: For button and icon hover effects (e.g., hvr-grow).
SweetAlert2: For elegant confirmation dialogs and error alerts.


PDF Generation: jsPDF and jsPDF-AutoTable for invoice downloads.
Database: MySQL (or compatible) for storing users, bookings, services, and inventory.
Styling: Custom CSS with glassmorphism effects and a luxurious color palette (#8b5a2b, #f5f5f5, #3c2f2f, #d4a373).
Fonts: Playfair Display (headings), Montserrat (body).

Installation
Follow these steps to set up the Ivory Glow Salon System locally.
Prerequisites

PHP >= 8.1
Composer
Node.js and npm
MySQL or compatible database
Git

Steps

Clone the Repository:
git clone https://github.com/your-username/ivory-glow-salon-system.git
cd ivory-glow-salon-system


Install Dependencies:
composer install
npm install
npm run build


Set Up Environment:

Copy .env.example to .env:cp .env.example .env


Update .env with your database credentials:DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ivory_glow
DB_USERNAME=your_username
DB_PASSWORD=your_password




Generate Application Key:
php artisan key:generate


Run Migrations:
php artisan migrate


Seed the Database (optional, for initial data):
php artisan db:seed


Set Up Storage Link:

Create a symlink for file storage (e.g., images):php artisan storage:link


Ensure storage/app/public/images/bg.jpg and storage/app/public/images/logo.png exist.


Start the Server:
php artisan serve

Access the application at http://localhost:8000.


Usage

Admin Access:

Navigate to the homepage and click the top-right dropdown icon.
Select "Admin Login" and use:
Email: admin@gmail.com
Password: 123


Manage staff, services, inventory, customers, reports, and shop details.


Customer Access:

Register via the homepage’s "Register" button.
Log in with your credentials to book appointments, view settings, or download invoices.
Use the contact form to send feedback.


Staff Access:

Select "Staff Login" from the top-right dropdown.
Log in with provided credentials to manage appointments and update your profile.


Contributing
Contributions are welcome! To contribute:

Fork the repository.
Create a new branch (git checkout -b feature/your-feature).
Commit your changes (git commit -m 'Add your feature').
Push to the branch (git push origin feature/your-feature).
Open a Pull Request.

Thank You!