# Document: Architecture & Technical Design

## 1. Tech Stack
*   **Framework**: Laravel 12 (Core)
*   **Frontend**: Tailwind CSS, Alpine.js, Blade
*   **Interactivity**: Livewire 3 (For both Public interactive elements and Admin CRUDs)
*   **Admin Dashboard**: Custom Built (Tailwind + Livewire Components)
*   **Access Control**: **Custom Native RBAC** (Database-driven Roles & Permissions)
*   **Media Handling**: Spatie Laravel MediaLibrary (Remains recommended for complex file handling, or Custom Service if strictly no-packages preferred)
*   **Icons**: Heroicons
*   **Database**: MySQL / PostgreSQL

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
