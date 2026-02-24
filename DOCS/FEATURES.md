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

## 4. Detailed Legacy System Breakdown (Web-DSTI)
*Detailed inventory of features from the legacy app to be migrated.*

### A. Public Frontend Modules
1.  **Landing Page**: Jumbotron/Sliders, Latest News, Quick Links, Useful Links.
2.  **Profile & Organization**:
    *   Static/Dynamic Pages (Vision, Mission, History, etc.).
    *   **Organizational Structure**: Dedicated view for structure.
    *   **Director Profile**: Specific page for the director.
    *   **Membership List**: List of personnel with sorting.
3.  **Informations (Berita)**:
    *   Categorized News/Articles (Pengumuman, Berita Utama, etc).
    *   Search/Filter functionality.
    *   Detail View with Rich Text & Images.
4.  **Services (Layanan)**:
    *   Service directory grouped by Categories.
    *   Detail pages for specific services.
5.  **Documents & Downloads**:
    *   Public document repository (PDF, Docx, etc).
    *   Categorized filtering for files.
    *   **Forms**: Downloadable form templates for services.
6.  **Media**:
    *   **Gallery**: Photo/Activity albums.
7.  **FAQ**:
    *   Frequently Asked Questions with Category filter.
8.  **Interaction**:
    *   **Contact Page**: Address, Maps, and Contact Info.
    *   **Contact Form**: Direct messaging to admin.

### B. Admin Dashboard Features (Backoffice)
1.  **Dashboard**:
    *   **Quick Statistics**: Summary of news, services, and inbox.
    *   **Profile Management**: Update admin credentials.
2.  **Content Management (CMS)**:
    *   **Jumbotron Manager**: Manage homepage sliders.
    *   **Page Manager**: CRUD for static/profile pages (Vision, Mission, etc).
    *   **News Editor**: Full CRUD + Image Uploads (Integrated).
    *   **Service Manager**: CRUD for Services & Categories.
    *   **FAQ Manager**: CRUD for Q&A pairs.
    *   **Link Manager**: Manage external/partner links.
3.  **Resource Management**:
    *   **Document Manager**: Centralized file uploads.
    *   **Gallery Manager**: Image album management.
    *   **Membership Manager**: CRUD for personnel with **Order/Sorting** feature.
4.  **Communication**:
    *   **Inbox Manager**: Read and manage messages from frontend.
    *   **Response System**: Mark as read or reply to inquiries.

---

## 5. Migration Strategy & Checklist
*Use this checklist to track the development of the new app based on legacy requirements.*

- [ ] **Core Auth & RBAC** (Superadmin vs Admin)
- [ ] **Dashboard Admin** (Modern UI + Stats)
- [ ] **CMS - News Module** (With SEO & Draft states)
- [ ] **CMS - Page Builder/Static Content** (For Vision/Mission/Director)
- [ ] **CMS - Service Directory**
- [ ] **Resource - Document & Form Center**
- [ ] **Resource - Image Gallery**
- [ ] **Organization - Membership & Structure** (With custom ordering)
- [ ] **Communication - Inbox & Contact System**
- [ ] **General - Useful Links & FAQ**
- [ ] **Public - Frontend Implementation** (Tailwind + Responsive Design)
