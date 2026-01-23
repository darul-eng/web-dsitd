# Document: Feature List & Analysis (Old App vs New App)

## 1. Overview
The legacy application (**web-dsti**) is a Content Management System (CMS) for the DSITD (Direktorat Sistem Informasi dan Teknologi Digital) built with Laravel 8. The goal is to migrate and modernize this into **web-dsitd** using Laravel 12, Tailwind CSS, and a robust, scalable architecture.

## 2. Feature Analysis

| Module | Legacy Feature (Laravel 8) | Modernized Feature (Laravel 12) |
| :--- | :--- | :--- |
| **Authentication** | Custom `LoginController`, `cekrole` middleware. | Laravel Breeze/Fortify + **Custom Flexible RBAC** (Mimicking Spatie but lightweight & custom). |
| **Admin Panel** | Custom Blade templates, standard controllers. | **Custom Modern Admin Dashboard**. Hand-crafted using Tailwind CSS & Livewire for maximum performance and granular control. |
| **News/Informations** | Basic Category + Information CRUD. | Enhanced News System with SEO fields, Draft/Publish states. |
| **Profile** | Specific Profile Category & Content. | Flexible Page Builder or Structured Dynamic Content. |
| **Layanan (Services)** | Service Category & Content. | Rich Service Directory with grouping and icon/media support. |
| **Documents** | File upload to public disk. | Secure Document Management with organized storage paths. |
| **Gallery** | Simple image upload. | Responsive Gallery with automatic image optimization. |
| **FAQ** | Category + FAQ list. | Searchable & Categorized FAQ with Livewire interaction. |
| **Inbox** | Contact form to database + Response. | Advanced Inquiry management with Email notifications. |
| **User/Admin MGMT** | Manual User CRUD with simple roles. | **Custom RBAC UI**: Manage Roles & Permissions dynamically via the admin panel. |

## 3. Improvements
1.  **Full Control & Performance**: By avoiding heavy admin panel packages (like Filament), we ensure the application remains lightweight using pure Laravel & Livewire.
2.  **Custom Authorization Engine**: We will build a `HasRoles` and `HasPermissions` trait system from scratch. This removes dependency bloat while keeping the powerful syntax (e.g., `$user->hasRole('admin')`).
3.  **Modern UI/UX**: Move to **Tailwind CSS** with a consistent Design System for both Front-end and Back-end.
4.  **Maintainability**: Implement **Service Classes** and **Action Classes** to separate business logic from controllers.
5.  **Security**: Native Laravel 12 security features, better sanitization, and robust custom RBAC middleware.
