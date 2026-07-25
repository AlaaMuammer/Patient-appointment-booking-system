# Clinic Appointment Booking & Management System

## Project Overview
This system automates clinic appointment operations, eliminating manual scheduling conflicts. It offers an intuitive interface for patients to view available time slots and book appointments, alongside a robust **Admin Dashboard** for managing doctor schedules, confirming patient visits, and overseeing clinic operations.

---

## Key Features

### Admin Dashboard
* **Time Slot Management:** Create, view, and manage doctor availability time slots.
* **Attendance Confirmation:** Track and update patient visit statuses in real-time (e.g., confirming visits upon arrival).
* **Appointment Management:** Clear overview of all upcoming, booked, and completed patient slots.

### Patient Portal
* **Account Management:** User registration, login, and secure session handling.
* **Browse Availability:** View available time slots across clinic schedules.
* **Appointment Booking:** Seamless online appointment booking workflow.

---

## Software Architecture & Design Patterns

The project is structured according to core Software Development Life Cycle (SDLC) standards and object-oriented design principles:

* **Model-View-Controller (MVC) Pattern:** Enforces strict separation of concerns:
  * Model: Manages database operations and business objects.
  * View: Handles user interface display templates and HTML rendering.
  * Controller: Handles incoming HTTP requests, session control, and logic execution.
* **Singleton Pattern:** Implemented in `DatabaseConnection.php` to ensure a single, reusable database instance throughout the request lifecycle.

---

## Tech Stack
* **Backend:** PHP (Native OOP)
* **Frontend:** HTML5, CSS3, JavaScript
* **Database:** MySQL
* **Tools & Server Environment:** XAMPP (Apache, MySQL), VS Code, Git & GitHub

## Demo Credentials
* Admin :
   * Email : admin@clinic.com
   * PassWord : 123456
* Doctor (Ahmed) :
   * Email : docgeneral@clinic.com
   * PassWord : 123456
* Doctor (Sara) :
   * Email : docpediatric@clinic.com
   * PassWord : 123456     
* Pationt (sama):
   * Email : sama@gmail.com
   * PassWord : 111
