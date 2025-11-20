# CarGo - Car Rental Management System
## A Comprehensive Field Work / Industrial Training Project

---

## Table of Contents
- [Project Overview](#project-overview)
- [System Architecture](#system-architecture)
- [Technology Stack](#technology-stack)
- [Project Structure](#project-structure)
- [Database Design](#database-design)
- [Feature Implementation](#feature-implementation)
- [Security Features](#security-features)
- [Installation Guide](#installation-guide)
- [Development Workflow](#development-workflow)
- [Testing and Quality Assurance](#testing-and-quality-assurance)

---

## Project Overview

### Introduction
CarGo is a modern, web-based **Car Rental Management System** designed to streamline vehicle rental operations through digital automation. Built with Laravel 12 framework, it provides a robust platform for both customers and administrators to manage vehicle rentals efficiently.

### Motivation
Traditional car rental systems suffer from:
- Manual paperwork and administrative overhead
- Lack of real-time inventory visibility
- Inefficient booking management
- Error-prone processes and double-bookings
- Limited customer engagement

CarGo addresses these challenges through comprehensive digital transformation.

### Project Objectives
1. **User-Centric Design**: Create an intuitive interface for vehicle browsing and booking
2. **Administrative Efficiency**: Provide comprehensive management tools for inventory and bookings
3. **Payment Integration**: Enable secure online subscription payments
4. **Data Integrity**: Ensure reliable data management using RDBMS
5. **Scalability**: Build a maintainable, extensible system architecture

---

## System Architecture

### Architectural Pattern: MVC (Model-View-Controller)

CarGo follows Laravel's implementation of the **MVC architectural pattern**, ensuring separation of concerns and maintainability.

```
┌─────────────────────────────────────────────────────┐
│                    USER INTERFACE                    │
│              (Blade Templates + Bootstrap)           │
└──────────────────┬──────────────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────────────┐
│                   CONTROLLERS                        │
│  ┌──────────────┬──────────────┬─────────────────┐  │
│  │ CarController│AppointmentCtrl│ AuthController │  │
│  └──────────────┴──────────────┴─────────────────┘  │
└──────────────────┬──────────────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────────────┐
│                     MODELS                           │
│  ┌──────────┬─────────────┬────────────┬─────────┐  │
│  │   Car    │ Appointment │    User    │ Subscrip│  │
│  └──────────┴─────────────┴────────────┴─────────┘  │
└──────────────────┬──────────────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────────────┐
│                  DATABASE LAYER                      │
│              SQLite / MySQL / PostgreSQL             │
└─────────────────────────────────────────────────────┘
```

### Component Description

#### 1. **View Layer** (Presentation)
- **Technology**: Blade templating engine
- **Styling**: Bootstrap 5 (Public), AdminLTE (Admin)
- **Location**: `resources/views/`
- **Components**:
  - Master layouts (`admin-master.blade.php`)
  - Page templates (`pages/`)
  - Reusable components (`common/`)

#### 2. **Controller Layer** (Business Logic)
- **Location**: `app/Http/Controllers/`
- **Key Controllers**:
  - `CarController.php` - Vehicle CRUD operations
  - `AppointmentController.php` - Booking management
  - `AuthController.php` - Authentication logic
  - `SubscriptionController.php` - Payment processing
  - `ContactController.php` - Inquiry management
  - `UserProfileController.php` - User account management
  - `HomeController.php` - Public pages

#### 3. **Model Layer** (Data)
- **Technology**: Eloquent ORM
- **Location**: `app/Models/`
- **Models**:
  - `Car.php` - Vehicle entity
  - `Appointment.php` - Booking entity (with relationships)
  - `User.php` - User authentication
  - `Subscription.php` - Payment records
  - `ContactMessage.php` - Contact inquiries

---

## Technology Stack

### Backend Technologies
| Component | Technology | Version | Purpose |
|-----------|-----------|---------|---------|
| Framework | Laravel | 12.x | PHP framework for web applications |
| Language | PHP | 8.2+ | Server-side programming language |
| ORM | Eloquent | Built-in | Database abstraction layer |
| Routing | Laravel Router | Built-in | URL routing and middleware |
| Authentication | Laravel Auth | Built-in | User authentication system |

### Frontend Technologies
| Component | Technology | Purpose |
|-----------|-----------|---------|
| Template Engine | Blade | Server-side rendering |
| CSS Framework | Bootstrap 5 | Responsive design (Public) |
| Admin Template | AdminLTE 3 | Dashboard interface |
| JavaScript | Vanilla JS | Client-side interactivity |
| Notifications | SweetAlert2 | User feedback alerts |

### Database
| Type | Default | Alternatives |
|------|---------|--------------|
| RDBMS | SQLite | MySQL, PostgreSQL |
| Schema | Migrations | Version-controlled |

### Third-Party Integrations
| Service | Purpose | Documentation |
|---------|---------|---------------|
| SSLCommerz | Payment gateway for subscriptions | Bangladesh payment provider |

### Development Tools
| Tool | Purpose |
|------|---------|
| Composer | PHP dependency management |
| NPM | Frontend package management |
| Vite | Asset bundling and HMR |
| Laravel Pint | Code style enforcement |

---

## Project Structure

### Complete Directory Tree

```
CarGo/
│
├── 📁 app/                          # Application core
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/          # Request handlers
│   │   │   ├── AppointmentController.php   (2.6 KB)
│   │   │   ├── AuthController.php          (2.7 KB)
│   │   │   ├── CarController.php           (4.5 KB)
│   │   │   ├── ContactController.php       (1.7 KB)
│   │   │   ├── Controller.php              (Base)
│   │   │   ├── HomeController.php          (1.3 KB)
│   │   │   ├── SubscriptionController.php  (12.2 KB)
│   │   │   └── UserProfileController.php   (3.7 KB)
│   │   └── Middleware/              # HTTP middleware
│   ├── 📁 Models/                   # Eloquent models
│   │   ├── Appointment.php         (412 B)
│   │   ├── Car.php                 (1.2 KB)
│   │   ├── ContactMessage.php      (261 B)
│   │   ├── Subscription.php        (530 B)
│   │   └── User.php                (1.2 KB)
│   └── 📁 Providers/               # Service providers
│
├── 📁 bootstrap/                    # Framework bootstrap
│   └── app.php
│
├── 📁 config/                       # Configuration files
│   ├── app.php                     # Application config
│   ├── database.php                # Database connections
│   ├── auth.php                    # Authentication config
│   └── ... (12 files total)
│
├── 📁 database/
│   ├── 📁 migrations/               # Database version control
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_08_11_023833_create_properties_table.php
│   │   ├── 2025_09_11_025156_create_appointments_table.php
│   │   ├── 2025_10_17_000001_add_brand_to_properties_table.php
│   │   ├── 2025_11_02_143019_rename_properties_to_car_info.php
│   │   ├── 2025_11_02_151923_create_subscriptions_table.php
│   │   └── 2025_11_10_000001_create_contact_messages_table.php
│   └── database.sqlite             # SQLite database file
│
├── 📁 public/                       # Web server root
│   ├── 📁 admin/                    # AdminLTE assets (1,673 files)
│   ├── 📁 site/                     # Public site assets
│   ├── 📁 uploads/                  # User uploads (cars, etc.)
│   ├── index.php                   # Application entry point
│   └── .htaccess                   # Apache configuration
│
├── 📁 resources/
│   ├── 📁 views/                    # Blade templates
│   │   ├── admin-master.blade.php  # Admin layout
│   │   ├── 📁 common/               # Reusable components
│   │   │   ├── footer.blade.php
│   │   │   ├── head.blade.php
│   │   │   ├── header.blade.php
│   │   │   ├── loader.blade.php
│   │   │   ├── master.blade.php    # Public layout
│   │   │   └── scripts.blade.php
│   │   └── 📁 pages/                # Page templates
│   │       ├── home.blade.php      (22.9 KB)
│   │       ├── about.blade.php     (10.3 KB)
│   │       ├── contact.blade.php   (8.6 KB)
│   │       ├── login.blade.php     (10.0 KB)
│   │       ├── register.blade.php  (11.9 KB)
│   │       ├── get-appointment.blade.php (8.4 KB)
│   │       ├── my-appointments.blade.php (3.0 KB)
│   │       ├── subscription.blade.php    (16.7 KB)
│   │       ├── subscription_success.blade.php
│   │       ├── user-profile.blade.php    (14.7 KB)
│   │       └── 📁 admin/            # Admin pages
│   │           ├── index.blade.php         # Dashboard
│   │           └── 📁 car/
│   │               ├── add-car.blade.php
│   │               ├── car-list.blade.php
│   │               └── edit-car.blade.php
│   │           └── 📁 appointment/
│   │               └── appointment-list.blade.php
│   │           └── 📁 contact/
│   │               └── contact-list.blade.php
│   └── 📁 css/                      # Custom stylesheets
│   └── 📁 js/                       # Custom JavaScript
│
├── 📁 routes/
│   └── web.php                     (6.6 KB) # Route definitions
│
├── 📁 storage/                      # Application storage
│   ├── 📁 app/                      # File storage
│   ├── 📁 framework/                # Framework files
│   └── 📁 logs/                     # Application logs
│
├── 📁 tests/                        # Automated tests
│
├── .env                            # Environment configuration
├── .env.example                    # Environment template
├── composer.json                   # PHP dependencies
├── package.json                    # Node dependencies
├── artisan                         # CLI tool
└── README.md                       # This file
```

---

## Database Design

### Entity-Relationship Overview

```
┌─────────────┐         ┌──────────────┐        ┌──────────────┐
│    User     │         │     Car      │        │ Subscription │
├─────────────┤         ├──────────────┤        ├──────────────┤
│ id (PK)     │    ┌───▶│ id (PK)      │        │ id (PK)      │
│ name        │    │    │ car_name     │        │ user_id (FK) │
│ email       │    │    │ car_type     │        │ plan_name    │
│ password    │    │    │ brand        │        │ amount       │
│ phone       │    │    │ price        │        │ status       │
│ address     │    │    │ seats        │        │ tran_id      │
│ created_at  │    │    │ doors        │        └──────────────┘
└──────┬──────┘    │    │ milage       │               ▲
       │           │    │ image        │               │
       │           │    │ status       │               │
       │           │    └──────────────┘               │
       │           │           ▲                       │
       │           │           │                       │
       ▼           │           │                       │
┌──────────────┐  │    ┌──────┴───────┐               │
│ Appointment  │──┘    │              │               │
├──────────────┤       │ belongs to   │               │
│ id (PK)      │       │              │        belongs to
│ user_id (FK) │───────┘              │               │
│ car_id (FK)  │                      │               │
│ date         │                      └───────────────┘
│ message      │
│ status       │ (Pending/Approved/Declined)
└──────────────┘

┌──────────────────┐
│ ContactMessage   │
├──────────────────┤
│ id (PK)          │
│ name             │
│ email            │
│ subject          │
│ message          │
│ status           │ (New/Read/Replied)
└──────────────────┘
```

### Table Schemas

#### 1. **users** Table
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | VARCHAR(255) | NOT NULL | User's full name |
| email | VARCHAR(255) | UNIQUE, NOT NULL | Email (also login) |
| password | VARCHAR(255) | NOT NULL | Hashed password |
| phone | VARCHAR(20) | NULLABLE | Contact number |
| address | TEXT | NULLABLE | Physical address |
| email_verified_at | TIMESTAMP | NULLABLE | Email verification |
| remember_token | VARCHAR(100) | NULLABLE | Session token |
| created_at | TIMESTAMP | NOT NULL | Registration date |
| updated_at | TIMESTAMP | NOT NULL | Last modification |

**Purpose**: Stores user authentication and profile information.

---

#### 2. **car_info** Table
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| car_name | VARCHAR(255) | NOT NULL | Vehicle name |
| car_type | VARCHAR(255) | NOT NULL | Type (SUV, Sedan, etc.) |
| brand | VARCHAR(255) | NOT NULL | Manufacturer |
| price | DECIMAL(10,2) | NOT NULL | Daily rental rate |
| seats | VARCHAR(255) | NULLABLE | Seating capacity |
| doors | VARCHAR(255) | NULLABLE | Number of doors |
| milage | VARCHAR(255) | NULLABLE | Fuel efficiency |
| image | TEXT | NULLABLE | Image path/URL |
| status | ENUM | DEFAULT 'Available' | Available/Rented |
| created_at | TIMESTAMP | NOT NULL | Added date |
| updated_at | TIMESTAMP | NOT NULL | Last update |

**Purpose**: Stores vehicle inventory with specifications.

**Note**: Originally named `properties`, renamed to `car_info` via migration for semantic clarity.

---

#### 3. **appointments** Table
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| user_id | BIGINT UNSIGNED | FOREIGN KEY → users.id | Booking user |
| car_id | BIGINT UNSIGNED | FOREIGN KEY → car_info.id | Booked vehicle |
| date | DATE | NOT NULL | Rental date |
| message | TEXT | NULLABLE | Customer message |
| status | ENUM | DEFAULT 'Pending' | Pending/Approved/Declined |
| created_at | TIMESTAMP | NOT NULL | Booking creation |
| updated_at | TIMESTAMP | NOT NULL | Status update |

**Purpose**: Manages vehicle booking requests.

**Relationships**:
- `belongsTo(User::class)`
- `belongsTo(Car::class)`

---

#### 4. **subscriptions** Table
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| user_id | BIGINT UNSIGNED | FOREIGN KEY → users.id | Subscriber |
| plan_name | VARCHAR(255) | NOT NULL | Basic/Premium/Pro |
| amount | DECIMAL(10,2) | NOT NULL | Payment amount |
| currency | VARCHAR(3) | DEFAULT 'BDT' | Currency code |
| tran_id | VARCHAR(255) | UNIQUE | Transaction ID |
| status | ENUM | NOT NULL | Pending/Completed/Failed |
| payment_method | VARCHAR(255) | NULLABLE | Payment channel |
| card_type | VARCHAR(50) | NULLABLE | Card type used |
| bank_tran_id | VARCHAR(255) | NULLABLE | Bank transaction ID |
| created_at | TIMESTAMP | NOT NULL | Payment initiation |
| updated_at | TIMESTAMP | NOT NULL | Status update |

**Purpose**: Records subscription payments via SSLCommerz.

---

#### 5. **contact_messages** Table
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique identifier |
| name | VARCHAR(255) | NOT NULL | Sender name |
| email | VARCHAR(255) | NOT NULL | Sender email |
| subject | VARCHAR(255) | NULLABLE | Message subject |
| message | TEXT | NOT NULL | Message content |
| status | ENUM | DEFAULT 'new' | new/read/replied |
| created_at | TIMESTAMP | NOT NULL | Submission time |
| updated_at | TIMESTAMP | NOT NULL | Last update |

**Purpose**: Stores customer inquiries from contact form.

---

### Database Migrations

The project uses Laravel's migration system for version control:

1. **0001_01_01_000000_create_users_table.php** - User authentication
2. **0001_01_01_000001_create_cache_table.php** - Caching layer
3. **0001_01_01_000002_create_jobs_table.php** - Queue jobs
4. **2025_08_11_023833_create_properties_table.php** - Initial vehicle table
5. **2025_09_11_025156_create_appointments_table.php** - Booking system
6. **2025_10_17_000001_add_brand_to_properties_table.php** - Add brand field
7. **2025_11_02_143019_rename_properties_to_car_info.php** - Semantic refactoring
8. **2025_11_02_151923_create_subscriptions_table.php** - Payment system
9. **2025_11_10_000001_create_contact_messages_table.php** - Contact form

---

## Feature Implementation

### 1. Authentication System

**Implementation**: Laravel's built-in authentication with custom controllers.

**Files**:
- Controller: `app/Http/Controllers/AuthController.php`
- Views: `resources/views/pages/login.blade.php`, `register.blade.php`

**Features**:
- User registration with validation
- Secure login with session management
- Password hashing (bcrypt)
- Remember me functionality
- Logout with session destruction

**Routes**:
```php
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginCheck']);
Route::get('/logout', [AuthController::class, 'logout']);
```

---

### 2. Vehicle Management (CRUD)

**Implementation**: Full CRUD operations for administrators.

**Controller**: `CarController.php`

**Operations**:

| Operation | Method | Route | Function |
|-----------|--------|-------|----------|
| **Create** | POST | `/add-car` | `addCar()` |
| **Read** | GET | `/dashboard/car-list` | `carList()` |
| **Update** | POST | `/edit-car` | `carUpdate()` |
| **Delete** | GET | `/delete-car/{id}` | `carDelete()` |

**Features**:
- Image upload handling
- Form validation
- Admin-only access
- SweetAlert confirmations

**Views**:
- `resources/views/pages/admin/car/add-car.blade.php`
- `resources/views/pages/admin/car/car-list.blade.php`
- `resources/views/pages/admin/car/edit-car.blade.php`

---

### 3. Appointment Booking System

**Implementation**: Customer booking with admin approval workflow.

**Controller**: `AppointmentController.php`

**Workflow**:
```
User Books → Status: Pending → Admin Reviews → Approve/Decline
```

**Functions**:
- `getAppointment()` - Display booking form
- `appointmentBooking()` - Process booking
- `myAppointments()` - User's booking history
- `getAppointmentList()` - Admin view all bookings
- `approveAppointment()` - Admin approval
- `declineAppointment()` - Admin rejection
- `deleteAppointment()` - Admin delete

**Business Logic**:
- Authentication required
- Car availability check
- Automated status tracking
- Email notifications (configurable)

---

### 4. Subscription & Payment System

**Implementation**: SSLCommerz payment gateway integration.

**Controller**: `SubscriptionController.php` (12.2 KB - most complex)

**Plans**:
| Plan | Price (BDT) | Features |
|------|------------|----------|
| Basic | 499 | Standard access |
| Premium | 999 | Priority support |
| Pro | 1,999 | All features |

**Payment Flow**:
```
1. User selects plan
2. System initiates SSLCommerz session
3. Redirect to payment gateway
4. User completes payment
5. SSLCommerz callback (success/fail/cancel)
6. Update subscription status
7. Show confirmation page
```

**Routes**:
```php
Route::get('/subscription', [SubscriptionController::class, 'index']);
Route::post('/subscription/initiate', [SubscriptionController::class, 'initiatePayment']);
Route::match(['get', 'post'], 'subscription/success', [SubscriptionController::class, 'success']);
Route::match(['get', 'post'], 'subscription/fail', [SubscriptionController::class, 'fail']);
Route::match(['get', 'post'], 'subscription/cancel', [SubscriptionController::class, 'cancel']);
```

**Security**:
- Transaction ID verification
- Signature validation
- Amount verification
- Status reconciliation

---

### 5. User Profile Management

**Implementation**: Complete profile CRUD with password update.

**Controller**: `UserProfileController.php`

**Features**:
- View profile
- Update name, email, phone, address
- Change password (with current password verification)
- Delete account (soft delete option)

**Routes**:
```php
Route::get('/profile', [UserProfileController::class, 'index']);
Route::post('/profile/update', [UserProfileController::class, 'updateProfile']);
Route::post('/profile/password', [UserProfileController::class, 'updatePassword']);
Route::delete('/profile/delete', [UserProfileController::class, 'deleteAccount']);
```

---

### 6. Contact Management System

**Implementation**: Contact form with admin management.

**Controller**: `ContactController.php`

**Features**:
- Public contact form
- Admin inbox
- Mark as read/replied
- Delete messages

**Status Workflow**:
```
new → read → replied
```

---

### 7. Admin Dashboard

**Implementation**: Statistical overview with AdminLTE.

**View**: `resources/views/pages/admin/index.blade.php`

**Metrics Displayed**:
- Total vehicles
- Total appointments
- Pending approvals
- Registered users
- Contact messages

**Features**:
- Charts and graphs
- Quick action buttons
- Recent activity feed
- Responsive design

---

## Security Features

### 1. Authentication & Authorization

**Email-Based Admin Access**:
```php
define('ADMIN_EMAIL', 'admin@university.edu');

// Middleware check:
if(!Auth::check()) return redirect()->route('login');
if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
```

**Implementation**: All admin routes protected with inline authentication checks.

---

### 2. Password Security

- **Hashing**: bcrypt algorithm (Laravel default)
- **Minimum Length**: 8 characters (configurable)
- **Verification**: Password confirmation on registration

---

### 3. Form Validation

**Server-Side Validation**:
```php
$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
]);
```

---

### 4. SQL Injection Prevention

- **Eloquent ORM**: Parameterized queries
- **Query Builder**: Automatic escaping

---

### 5. CSRF Protection

All POST forms include CSRF token:
```blade
@csrf
```

---

### 6. File Upload Security

**Car Image Uploads**:
- Validation for image types (jpg, png, jpeg)
- Max file size limits
- Stored in public/uploads/cars/
- Filename sanitization

---

### 7. Session Management

- Secure session cookies
- Automatic session timeout
- Remember me token rotation

---

## Installation Guide

### Prerequisites
- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 16.x or higher
- **NPM**: Latest version
- **Database**: SQLite (default) or MySQL/PostgreSQL
- **Web Server**: Apache or Nginx

### Step-by-Step Installation

#### 1. Clone Repository
```bash
git clone <repository-url>
cd CarGo
```

#### 2. Install Dependencies
```bash
# PHP dependencies
composer install

# Frontend dependencies
npm install
```

#### 3. Environment Configuration
```bash
# Copy example environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Configure `.env` File

**Database (SQLite - Default)**:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

**Database (MySQL)**:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cargo
DB_USERNAME=root
DB_PASSWORD=your_password
```

**SSLCommerz Payment Gateway**:
```env
SSLC_STORE_ID=your_store_id
SSLC_STORE_PASSWORD=your_store_password
SSLC_IS_SANDBOX=true  # false for production
```

#### 5. Database Setup
```bash
# Create SQLite file (if using SQLite)
type nul > database\database.sqlite

# Run migrations
php artisan migrate
```

#### 6. Storage Link
```bash
# Create symbolic link for uploads
php artisan storage:link
```

#### 7. Build Assets (Optional)
```bash
# Development
npm run dev

# Production
npm run build
```

#### 8. Start Development Server
```bash
php artisan serve
```

Access the application at: `http://localhost:8000`

---

### Creating Admin Account

1. Register a new user on `/register`
2. Manually update the email to `admin@university.edu` in the database:
   ```sql
   UPDATE users SET email = 'admin@university.edu' WHERE id = 1;
   ```
3. Login and access `/dashboard`

---

## Development Workflow

### Local Development

**Concurrent Development**:
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server (if using)
npm run dev

# Terminal 3: Queue worker (if needed)
php artisan queue:work
```

---

### File Structure Conventions

**Controllers**: Plural nouns (e.g., `CarsController`)
**Models**: Singular nouns (e.g., `Car`)
**Views**: Kebab-case (e.g., `car-list.blade.php`)
**Routes**: RESTful naming

---

### Coding Standards

**Laravel Pint** for code style:
```bash
./vendor/bin/pint
```

**PSR-12 Standard**: PHP coding standards

---

## Testing and Quality Assurance

### Manual Testing Checklist

#### Public Features
- [ ] User registration with validation
- [ ] User login/logout
- [ ] Browse vehicles
- [ ] Book appointment
- [ ] View my appointments
- [ ] Contact form submission
- [ ] Profile update
- [ ] Password change
- [ ] Subscription payment

#### Admin Features
- [ ] Admin login
- [ ] Dashboard statistics
- [ ] Add new car with image
- [ ] Edit car details
- [ ] Delete car
- [ ] View appointment list
- [ ] Approve appointment
- [ ] Decline appointment
- [ ] Delete appointment
- [ ] View contact messages
- [ ] Mark contact as read
- [ ] Delete contact message

---

### Performance Optimization

**Cache Clearing**:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

**Optimization** (Production):
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Routes Documentation

### Complete Route Table

| Method | URI | Name | Controller@Action | Auth | Admin |
|--------|-----|------|-------------------|------|-------|
| GET | `/` | home | HomeController@index | No | No |
| GET | `/about` | - | Closure | No | No |
| GET | `/contact` | - | Closure | No | No |
| POST | `/contact` | contactStore | ContactController@store | No | No |
| GET | `/register` | register | AuthController@register | No | No |
| POST | `/register` | signup | AuthController@signup | No | No |
| GET | `/login` | login | AuthController@login | No | No |
| POST | `/login` | loginCheck | AuthController@loginCheck | No | No |
| GET | `/logout` | logout | AuthController@logout | Yes | No |
| GET | `/get-appointment` | getAppointment | AppointmentController@getAppointment | Yes | No |
| POST | `/get-appointment` | appointmentBooking | AppointmentController@appointmentBooking | Yes | No |
| GET | `/my-appointments` | myAppointments | AppointmentController@myAppointments | Yes | No |
| GET | `/subscription` | subscription.index | SubscriptionController@index | Yes | No |
| POST | `/subscription/initiate` | subscription.initiate | SubscriptionController@initiatePayment | Yes | No |
| GET/POST | `/subscription/success` | subscription.success | SubscriptionController@success | No | No |
| GET/POST | `/subscription/fail` | subscription.fail | SubscriptionController@fail | No | No |
| GET/POST | `/subscription/cancel` | subscription.cancel | SubscriptionController@cancel | No | No |
| GET | `/subscription/success-page` | subscription.success.page | Closure | Yes | No |
| GET | `/profile` | userProfile | UserProfileController@index | Yes | No |
| POST | `/profile/update` | userProfile.update | UserProfileController@updateProfile | Yes | No |
| POST | `/profile/password` | userProfile.password | UserProfileController@updatePassword | Yes | No |
| DELETE | `/profile/delete` | userProfile.delete | UserProfileController@deleteAccount | Yes | No |
| GET | `/dashboard` | dashboard | Closure | Yes | Yes |
| GET | `/dashboard/add-car` | - | CarController@index | Yes | Yes |
| GET | `/dashboard/car-list` | carList | CarController@carList | Yes | Yes |
| POST | `/add-car` | - | CarController@addCar | Yes | Yes |
| GET | `/dashboard/edit-car/{id}` | editCar | CarController@editCar | Yes | Yes |
| POST | `/edit-car` | carUpdate | CarController@carUpdate | Yes | Yes |
| GET | `/delete-car/{id}` | carDelete | CarController@carDelete | Yes | Yes |
| GET | `/dashboard/appointment-list` | getAppointmentList | AppointmentController@getAppointmentList | Yes | Yes |
| GET | `/appointment-approve/{id}` | approveAppointment | AppointmentController@approveAppointment | Yes | Yes |
| GET | `/appointment-decline/{id}` | declineAppointment | AppointmentController@declineAppointment | Yes | Yes |
| GET | `/appointment-delete/{id}` | deleteAppointment | AppointmentController@deleteAppointment | Yes | Yes |
| GET | `/dashboard/contact-list` | contactList | ContactController@index | Yes | Yes |
| GET | `/contact-mark-read/{id}` | contactMarkAsRead | ContactController@markAsRead | Yes | Yes |
| GET | `/contact-mark-replied/{id}` | contactMarkAsReplied | ContactController@markAsReplied | Yes | Yes |
| GET | `/contact-delete/{id}` | contactDelete | ContactController@delete | Yes | Yes |

---

## Deployment Considerations

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database
- [ ] Set SSLCommerz to production mode (`SSLC_IS_SANDBOX=false`)
- [ ] Configure mail server for notifications
- [ ] Run `php artisan optimize`
- [ ] Set appropriate file permissions (755 for directories, 644 for files)
- [ ] Configure SSL certificate (HTTPS)
- [ ] Set up backup strategy
- [ ] Configure error monitoring (Sentry, Bugsnag, etc.)

---

## Future Enhancements

### Recommended Features
1. **Mobile Application** - Native iOS/Android apps
2. **Advanced Search** - Filters by transmission, fuel type, year
3. **GPS Tracking** - Real-time vehicle tracking
4. **Rating System** - User reviews for vehicles
5. **Multiple Payment Gateways** - Stripe, PayPal integration
6. **Email Notifications** - Booking confirmations, reminders
7. **SMS Notifications** - Via Twilio or similar
8. **Multi-language Support** - i18n implementation
9. **API Development** - RESTful API for mobile apps
10. **Advanced Analytics** - Revenue reports, usage statistics

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Support & Contact

For academic inquiries or project support:
- **Institution**: Northern University of Business and Technology Khulna
- **Department**: Computer Science and Engineering
- **Course**: CSE 4100 - Field Work / Industrial Training

---

## Acknowledgments

This project is developed as part of the **CSE 4100 Field Work / Industrial Training** course at **Northern University of Business and Technology Khulna (NUBTK)**.

**Technologies Used**:
- Laravel Framework by Taylor Otwell
- AdminLTE by ColorlibHQ
- Bootstrap by Twitter
- SSLCommerz Payment Gateway

---

**Last Updated**: November 2025
**Version**: 1.0.0
