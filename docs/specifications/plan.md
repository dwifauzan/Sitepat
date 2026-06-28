PROJECT PLAN: LATELINK SMAKENSA
===============================
Student Late Attendance Tracking System

PHASE 1: AUDIT & CLEANUP (Week 1)
----------------------------------
1.1 Schema Cleanup
  - Remove redundant `role` column from users table (migration 2024_05_03_170439)
  - Remove unused `role_user` pivot table (migration 2024_07_20_103934)
  - Remove unused `admins` table (migration 2024_05_03_164149)
  - Consolidate migrations into a clean state

1.2 Dead Code Removal
  - Remove commented-out route for error page
  - Remove commented-out qrscan.blade.php content
  - Remove unused CheckRole middleware or activate it across routes
  - Remove unused yajra/laravel-datatables dependency if not needed
  - Remove unused TrustHosts middleware from filesystem

1.3 Fix Scheduled Tasks
  - Create ResetTelatHourly artisan command (currently referenced but missing)
  - Verify yearly grade promotion logic works correctly

PHASE 2: CORE ENHANCEMENTS (Week 2-3)
--------------------------------------
2.1 Authentication & Authorization
  - Activate CheckRole middleware on all protected routes
  - Implement proper role-based access for all 3 roles (admin, superadmin, operator)
  - Improve login: switch to email-based or keep name-based with better validation
  - Add password reset functionality

2.2 Dashboard Improvements
  - Add monthly/yearly chart options
  - Add filtering by class and major on dashboard
  - Add export dashboard data (PDF/Excel)
  - Show per-class and per-major lateness statistics

2.3 QR Code System
  - Fix and activate proper QR scan flow if qrscan.blade.php is needed
  - Add time tracking to lateness records (not just date)
  - Add validation to prevent duplicate scans within time window
  - Add QR code download/print for all students in a class

PHASE 3: DATA MANAGEMENT (Week 3-4)
-------------------------------------
3.1 Student Management
  - Add import/export CSV/Excel for student data
  - Add batch operations (assign class, assign major)
  - Add student photo upload
  - Add search/filter improvements to DataTable
  - Add soft deletes for students

3.2 Lateness Reports
  - Generate weekly/monthly/semester reports
  - Export reports to PDF/Excel
  - Email notifications to parents (SMS gateway integration)
  - Guardian dashboard for homeroom teachers

3.3 Data Integrity
  - Add proper foreign key constraints with cascading deletes
  - Add validation rules for all forms
  - Add unique validation for NISN
  - Prevent deletion of majors/classes that have associated students

PHASE 4: UI/UX REFINEMENT (Week 4-5)
--------------------------------------
4.1 Design Consistency
  - Unify Bootstrap version (migrate all pages to Bootstrap 4 or 5)
  - Responsive design improvements
  - Loading states and error handling
  - Form validation feedback improvements

4.2 AdminLTE Upgrades
  - Custom skin/theme refinements
  - Dark mode support
  - Mobile-friendly sidebar
  - Notification system for late arrivals

PHASE 5: TESTING & QA (Week 5-6)
----------------------------------
5.1 Test Suite
  - Unit tests for models and relationships
  - Feature tests for all CRUD operations
  - QR scan flow integration tests
  - Authentication and authorization tests
  - Form validation tests

5.2 Quality Assurance
  - PHPStan/Psalm static analysis
  - Blade view review
  - Security audit (XSS, CSRF, SQL injection)
  - Performance testing with realistic data volumes
  - Cross-browser testing

PHASE 6: DEPLOYMENT & DOCUMENTATION (Week 6)
---------------------------------------------
6.1 Documentation
  - API documentation if endpoints are exposed
  - User manual for operators
  - Admin manual for administrators
  - Deployment guide

6.2 Deployment
  - Production environment setup
  - Database migration and seeding
  - QR code printer setup guidance
  - Backup strategy implementation

6.3 Monitoring
  - Error logging setup (Laravel Telescope or similar)
  - Usage analytics
  - Scheduled task monitoring

TIMELINE SUMMARY
----------------
Phase 1: Audit & Cleanup        - Week 1
Phase 2: Core Enhancements      - Weeks 2-3
Phase 3: Data Management        - Weeks 3-4
Phase 4: UI/UX Refinement       - Weeks 4-5
Phase 5: Testing & QA           - Weeks 5-6
Phase 6: Deployment & Docs      - Week 6

Total estimated timeline: 6 weeks

PRIORITIES
----------
P0 (Critical - must do):
  - Fix missing ResetTelatHourly command
  - Implement proper role middleware
  - Add validation to prevent lateness recording errors
  - Clean up schema inconsistencies

P1 (Important - should do):
  - Parent notification system
  - CSV import/export for student data
  - Dashboard filtering by class/major
  - Time tracking on lateness records

P2 (Nice to have):
  - Dark mode
  - Student photo upload
  - SMS/email notifications
  - Mobile app or PWA support
