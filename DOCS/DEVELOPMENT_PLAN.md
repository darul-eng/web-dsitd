# Document: Development Plan

## Phase 1: Foundation & Custom Identification (Week 1)
1.  **Initialize Laravel 12** (Completed).
2.  **Tailwind CSS Setup**:
    *   Install & Configure Tailwind.
    *   Set up fonts and colors (DSITD Theme).
3.  **Custom RBAC Implementation**:
    *   Create migrations: `roles`, `permissions`, pivot tables.
    *   Create Models: `Role`, `Permission`.
    *   Implement `HasRoles` trait.
    *   Create Middleware (`RoleMiddleware`, `PermissionMiddleware`).
    *   Seed default roles (Superadmin, Admin, User).
4.  **Admin Layout Base**:
    *   Create `layouts.admin` blade template.
    *   Build Sidebar and Topbar components.
    *   Implement Authentication (Login/Logout) customized for Admin.
    *   **Admin Dashboard**: Simple dashboard with summary widgets (Stats).

## Phase 2: Core CMS & Visuals (Week 2-3)
1.  **News & Information Module**:
    *   **Admin**: CRUD Controller, News Editor with Integrated Image Upload, Draft/Publish states.
    *   **Public**: News Index (List) and News Detail pages.
2.  **Page & Profile Management**:
    *   **Page Manager**: CRUD for static content (Visi, Misi, Sejarah, Profil Direktur).
    *   **Jumbotron Manager**: CRUD for Home Sliders/Banners.
    *   **Link Manager**: CRUD for "Link Terkait" / Useful Links.
3.  **User & Role Management Module**:
    *   UI to Add/Edit Users and Assign Roles.
    *   UI to Manage Permissions dynamically.

## Phase 3: Resource & Organizational Management (Week 4)
1.  **Services & Documents**:
    *   **Service Manager**: CRUD for Services and Service Categories.
    *   **Document Manager**: Centralized File/Form Uploads (PDF, Docx) for download.
2.  **Organizational Structure**:
    *   **Membership Manager**: CRUD for personnel/members.
    *   **Sorting System**: Implement drag-and-drop or numeric ordering for members.
    *   **Structure View**: Frontend representation of the organization.
3.  **Media & Interactions**:
    *   **Gallery**: Image album management with multi-upload.
    *   **FAQ System**: Categorized Q&A with Livewire "Search as you type".

## Phase 4: Communication, Polish & Handover (Week 5)
1.  **Inbox & Communication**:
    *   **Contact Form**: Public contact form.
    *   **Inbox Manager**: Admin interface to view and respond to messages.
2.  **Authorization & Security Hardening**:
    *   Apply Policies to all Admin Controllers.
    *   Strict validation and sanitization.
3.  **SEO & Public Frontend**:
    *   Finalize Landing Page design (integrating Jumbotron, News, Links).
    *   Meta tags optimization for all dynamic pages.
    *   Image compression and optimization.
4.  **Data Migration & Launch**:
    *   Import legacy data from `web-dsti` database.
    *   UAT & Final Deployment.
