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

## Phase 2: Core CMS Features (Week 2-3)
1.  **News & Information Module**:
    *   **Admin**: CRUD Controller, Form for Creating/Editing News (CKEditor or Trix), Image Upload.
    *   **Public**: Index Page (List), Detail Page.
2.  **User & Role Management Module**:
    *   UI to Add/Edit Users.
    *   UI to Assign Roles to Users.
    *   UI to Manage Permissions.
3.  **Profile & Services**:
    *   CRUDs for Profiles (Structure, Vision/Mission).
    *   CRUDs for Services and Service Categories.

## Phase 3: Interactive & Engagement Features (Week 4)
1.  **FAQ System**:
    *   Livewire Component for "Search as you type" on Frontend.
    *   Admin CRUD for FAQs.
2.  **Inbox & Forms**:
    *   Contact Form (Public).
    *   Inbox Manager (Admin) with ability to Reply.
3.  **Gallery**:
    *   Multi-image uploader in Admin.
    *   Masonry or Grid layout gallery in Public.

## Phase 4: Security, Optimization & Handover (Week 5)
1.  **Authorization Hardening**:
    *   Apply Policies to all Admin Controllers.
    *   Ensure strict validation on all forms.
2.  **SEO & Performance**:
    *   Meta tags optimization.
    *   Image compression logic.
3.  **Data Migration**:
    *   Write scripts to import data from the old `web-dsti` database (if needed).
4.  **UAT & Launch**.
