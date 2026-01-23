# Document: Architecture & Technical Design

## 1. Tech Stack
*   **Framework**: Laravel 12 (Core)
*   **Frontend**: Tailwind CSS, Alpine.js, Blade
*   **Interactivity**: Livewire 3 (For both Public interactive elements and Admin CRUDs)
*   **Admin Dashboard**: Custom Built (Tailwind + Livewire Components)
*   **Access Control**: **Custom Native RBAC** (Database-driven Roles & Permissions)
*   **Media Handling**: Spatie Laravel MediaLibrary (Remains recommended for complex file handling, or Custom Service if strictly no-packages preferred)
*   **Icons**: Heroicons
*   **Database**: MySQL

## 2. Design Patterns & Principles

### A. Repository & Service Pattern
To ensure the application is easy to test and maintain:
*   **Models**: Clean Eloquent models.
*   **Services**: Handle complex business logic (e.g., `NewsService`, `DocumentService`).
*   **Actions**: single-responsibility classes for tasks like `CreateUserAction`, `AssignRoleAction`.

### B. Controller Strategy
*   **Public Controllers**: Standard Laravel controllers rendering Blade views or Livewire full-page components.
*   **Admin Controllers**: Since we are building the admin panel manually, we will organize Admin controllers under `App\Http\Controllers\Admin`.
*   **Component-Driven**: Extensive use of Livewire components for reusable UI parts (Data Tables, Forms, Modals).

### C. Custom Authorization System (The "Lite-Spatie" Approach)
We will implement a custom RBAC system:
1.  **Database Tables**: `roles`, `permissions`, `role_user`, `permission_role`.
2.  **Traits**: `HasRoles` trait on the User model.
3.  **Gates/Policies**: Registering standard Laravel Gates based on these DB permissions.
4.  **Middleware**: `RoleMiddleware` and `PermissionMiddleware` to protect routes.

## 3. Recommended Folder Structure
```text
app/
├── Actions/            # Single responsibility business logic
├── Services/           # Complex domain logic
├── Traits/             # Shared logic (e.g., HasRoles, HasImage)
├── Http/
│   ├── Controllers/
│   │   ├── Admin/      # Admin Panel Controllers
│   │   ├── Web/        # Public facing controllers
│   │   └── Api/        # API endpoints if needed
│   └── Livewire/
│       ├── Admin/      # Admin UI Components (Tables, Forms)
│       └── Public/     # Public UI Components (Search, Filter)
├── Models/             # Database models
└── Policies/           # Authorization logic

resources/
├── css/                # Tailwind & custom CSS
├── js/                 # Alpine.js & custom JS
└── views/
    ├── admin/          # Admin Dashboard Views
    ├── web/            # Public Website Views
    ├── components/     # Reusable Blade/Livewire components
    └── layouts/        # Page layouts (Admin vs Public)
```

## 4. UI/UX Strategy
*   **Admin Dashboard**:
    *   Sidebar Navigation (Collapsible).
    *   Top Navbar (Profile, Notifications).
    *   Breadcrumbs.
    *   Card-based Layout for Forms and Tables.
*   **Public Site**:
    *   Modern, Clean, Responsive.
    *   Dark Mode Support.

## 5. Software Engineering Standards & Best Practices
To ensure the application is robust, scalable, and maintainable, we rigorously adhere to the following modern software engineering principles:

### A. Core Principles
1.  **SOLID Principles**:
    *   **S**ingle Responsibility: Each class (especially Actions/Services) has one job.
    *   **O**pen/Closed: Entities are open for extension logic but closed for modification.
    *   **L**iskov Substitution: Derived classes must be substitutable for their base classes.
    *   **I**nterface Segregation: Clients should not be forced to depend on interfaces they do not use.
    *   **D**ependency Inversion: Depend on abstractions, not concretions.
2.  **DRY (Don't Repeat Yourself)**: Logic is centralized in Services, Actions, or Traits. We strictly avoid duplicating logic across Controllers.
3.  **KISS (Keep It Simple, Stupid)**: Avoid over-engineering. Solutions should be as simple as possible to achieve the goal.
4.  **Composition over Inheritance**: Prefer composing objects with behaviors (Traits/Dependency Injection) rather than deep class inheritance hierarchies.

### B. Architecture & Code Quality
1.  **Separation of Concerns**:
    *   Strict boundary between **Business Logic** (Services/Actions), **Presentation** (Controllers/Views), and **Data Access** (Models).
    *   Controllers should be "skinny": responsible only for request handling and response return.
2.  **Type Safety**:
    *   Strict typing (`declare(strict_types=1);`) where applicable.
    *   Comprehensive return type declarations and property typing to catch errors at compile time.
3.  **Modern PHP Features**:
    *   Utilization of PHP 8.2+ features: Enums, Readonly Classes, Match Expressions, and Constructor Promotion.

### C. Scalability & Reliability (12-Factor App Influence)
1.  **Environment Config**: Strict separation of config from code (using `.env`).
2.  **Stateless Processes**: The app is designed to be stateless, allowing horizontal scaling (using Redis for Session/Cache).
3.  **Database Integrity**:
    *   Enforced Foreign Keys.
    *   Proper Indexing for performance.
    *   Atomic Transactions for critical data mutations.

## 6. Routing Structure & Organization

### A. Route File Organization
Routes are organized by context and purpose in the `routes/` directory:

```text
routes/
├── web.php           # Public-facing web routes
├── admin.php         # Admin panel routes (prefix: /admin)
├── api.php           # Public API endpoints (prefix: /api)
└── channels.php      # Broadcasting channels
```

### B. Web Routes (`routes/web.php`)
Public-facing routes for the website:

```php
// Homepage & Static Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// News & Information
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Services
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
});

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
```

### C. Admin Routes (`routes/admin.php`)
Protected admin panel routes with authentication and authorization:

```php
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])
        ->name('dashboard');
    
    // User Management (Superadmin only)
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('users', Admin\UserController::class);
        Route::resource('roles', Admin\RoleController::class);
        Route::resource('permissions', Admin\PermissionController::class);
    });
    
    // Content Management
    Route::middleware(['permission:manage-content'])->group(function () {
        Route::resource('news', Admin\NewsController::class);
        Route::resource('services', Admin\ServiceController::class);
        Route::resource('faqs', Admin\FaqController::class);
        Route::resource('gallery', Admin\GalleryController::class);
    });
    
    // Inbox Management
    Route::middleware(['permission:manage-inbox'])->group(function () {
        Route::get('inbox', [Admin\InboxController::class, 'index'])->name('inbox.index');
        Route::get('inbox/{id}', [Admin\InboxController::class, 'show'])->name('inbox.show');
        Route::post('inbox/{id}/reply', [Admin\InboxController::class, 'reply'])->name('inbox.reply');
    });
    
    // Profile & Settings
    Route::get('profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [Admin\ProfileController::class, 'update'])->name('profile.update');
});
```

### D. API Routes (`routes/api.php`)
RESTful API endpoints (if needed):

```php
Route::prefix('v1')->group(function () {
    // Public APIs
    Route::get('news', [Api\NewsController::class, 'index']);
    Route::get('news/{id}', [Api\NewsController::class, 'show']);
    
    // Authenticated APIs
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('contact', [Api\ContactController::class, 'store']);
    });
});
```

### E. Route Naming Conventions
Follow consistent naming patterns:

1.  **Resource Routes**: Use `{resource}.{action}` format
    ```php
    news.index, news.show, news.create, news.store, 
    news.edit, news.update, news.destroy
    ```

2.  **Admin Routes**: Prefix with `admin.`
    ```php
    admin.dashboard, admin.users.index, admin.news.create
    ```

3.  **API Routes**: Prefix with `api.` (optional, since /api prefix already exists)
    ```php
    api.news.index, api.users.show
    ```

### F. Route Middleware Strategy

**Authentication Middleware:**
*   `auth`: Requires authenticated user
*   `auth:sanctum`: For API authentication

**Authorization Middleware:**
*   `role:{role_name}`: Checks if user has specific role
*   `permission:{permission_name}`: Checks if user has specific permission
*   Custom middleware chain: `['auth', 'role:admin', 'permission:manage-users']`

**Example Implementation:**
```php
// Single role check
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin-only routes
});

// Permission-based access
Route::middleware(['auth', 'permission:edit-news'])->group(function () {
    // Routes for users with edit-news permission
});

// Multiple permissions (OR logic)
Route::middleware(['auth', 'permission:edit-news|delete-news'])->group(function () {
    // Routes for users with either permission
});
```

### G. Route Registration Best Practices

1.  **Grouping**: Group related routes for better organization
2.  **Naming**: Always name routes for easier reference in views and controllers
3.  **Prefixing**: Use prefixes for logical route segments
4.  **Middleware**: Apply middleware at group level when possible
5.  **RESTful**: Follow RESTful conventions for resource routes
6.  **Versioning**: Version API routes (v1, v2) for backward compatibility

**Example of Well-Organized Routes:**
```php
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        
        Route::resource('news', NewsController::class)
            ->middleware('permission:manage-content');
            
        Route::resource('users', UserController::class)
            ->middleware('permission:manage-users');
    });
```
