PROJECT SPECIFICATIONS: LATELINK SMAKENSA
===========================================
Student Late Attendance Tracking System
SMKN 1 Bondowoso (SMAKENSA)

1. OVERVIEW
-----------
A web-based system for tracking and managing student lateness at SMKN 1 Bondowoso.
Uses QR code scanning to record lateness, provides dashboards with weekly statistics,
and supports role-based access control. Built with Laravel 9.

2. OBJECTIVES
-------------
- Digitize the student lateness recording process
- Replace manual paper-based attendance with QR code scanning
- Provide real-time data on student lateness patterns
- Enable role-based management of student, class, and major data
- Generate reports for administrators and homeroom teachers

3. TECHNOLOGY STACK
-------------------
Backend:
  - Framework: Laravel 9
  - PHP: ^8.0
  - Database: MySQL
  - Authentication: Laravel Auth (session-based, name/password)
  - API Tokens: Laravel Sanctum

Frontend:
  - Template Engine: Blade
  - UI Framework: AdminLTE 3 (Bootstrap 4)
  - Also uses Bootstrap 5 on standalone pages
  - Build Tool: Laravel Mix 6 (Webpack)
  - JavaScript: jQuery (no SPA framework)
  - Charts: Chart.js

QR Code:
  - Generation: simplesoftwareio/simple-qrcode (PHP)
  - Scanning: html5-qrcode (JavaScript via CDN)

3.1 INSTALLED PACKAGES
composer:
  - laravel/framework ^9.0
  - laravel/sanctum ^2.14
  - laravel/tinker ^2.7
  - fruitcake/laravel-cors ^2.0.5
  - guzzlehttp/guzzle ^7.2
  - simplesoftwareio/simple-qrcode ^4.2
  - yajra/laravel-datatables-oracle ~9.0

npm:
  - axios ^1.7.2
  - html5-qrcode ^2.3.8
  - laravel-mix ^6.0.6
  - lodash ^4.17.19

4. USER ROLES
-------------
Defined in roles table and DatabaseSeeder:
  id=1: admin      - Full access to all features
  id=2: superadmin - Elevated access
  id=3: operator   - Limited access

Authorization is handled by checking Auth::user()->role_id == 1 (admin gate)
in controller methods. A CheckRole middleware exists but is unused.

Seeder creates accounts:
  - admin / admin22 (role_id=1)
  - operator / operator22 (role_id=2)

5. DATABASE SCHEMA
------------------

5.1 roles
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  nama_role       VARCHAR(255)
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

5.2 users
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  name            VARCHAR(255)
  email           VARCHAR(255) UNIQUE
  email_verified_at TIMESTAMP NULL
  password        VARCHAR(255)
  role_id         BIGINT UNSIGNED FK -> roles.id
  role            VARCHAR(255) DEFAULT 'user'  [redundant/unused]
  remember_token  VARCHAR(100) NULL
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

5.3 kelas (Classes)
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  Tingkat_kelas   VARCHAR(255)  [grade level: X, XI, XII]
  Nama_kelas      VARCHAR(255)  [class name]
  Walikelas       VARCHAR(255)  [homeroom teacher]
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

5.4 jurusan (Majors)
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  Nama_jurusan    VARCHAR(255)  [major name]
  Nama_kaproli    VARCHAR(255)  [head of major]
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

5.5 datasiswa (Students)
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  Nisn            BIGINT(20)     [national student ID]
  Nama_siswa      VARCHAR(255)   [student name]
  Jenis_kelamin   VARCHAR(255)   [gender]
  kelas_id        BIGINT UNSIGNED FK -> kelas.id
  jurusan_id      BIGINT UNSIGNED FK -> jurusan.id
  Alamat          VARCHAR(255)   [address]
  No_Handphone    BIGINT(20)     [phone number]
  Nama_Ortu_Ayah  VARCHAR(255)   [father's name]
  Nama_Ortu_Ibu   VARCHAR(255)   [mother's name]
  No_Handphone_Ayah BIGINT(20)   [father's phone]
  No_Handphone_Ibu  BIGINT(20)   [mother's phone]
  Telat           INTEGER DEFAULT 0  [late counter]
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

5.6 keterlambatans (Lateness Records)
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  Nisn_siswa      BIGINT(20)     [student NISN who was late]
  Tanggal         DATE           [date of lateness]
  jurusan_id      BIGINT UNSIGNED FK -> jurusan.id
  kelas_id        BIGINT UNSIGNED FK -> kelas.id
  Telat           INTEGER DEFAULT 1
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

5.7 admins (Legacy/Unused)
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  name            VARCHAR(255)
  password        VARCHAR(255)
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

5.8 role_user (Pivot - Unused)
  id              BIGINT UNSIGNED PK AUTO_INCREMENT
  role_id         BIGINT UNSIGNED FK -> roles.id
  user_id         BIGINT UNSIGNED FK -> users.id
  created_at      TIMESTAMP NULL
  updated_at      TIMESTAMP NULL

6. RELATIONSHIPS
----------------
roles 1---N users
kelas 1---N datasiswa, 1---N keterlambatans
jurusan 1---N datasiswa, 1---N keterlambatans
datasiswa 1---N keterlambatans

7. ROUTES
---------

Authentication:
  GET  /                          LoginController@login
  POST /login/exceute             LoginController@actionLogin
  POST /logout                    LoginController@logout

Dashboard & Home:
  GET  /home                      AllController@index
  GET  /dashboard                 AllController@dash
  GET  /dashboard/create          AllController@dashCreate
  POST /dashboard/create/Action   AllController@dashCreateAction
  GET  /dashboard/update/{id}     AllController@dashUpdate
  POST /dashboard/update/action/{id} AllController@dashUpdateAction
  DELETE /dashboard/delete/{id}   AllController@dashDelete

Student Management:
  GET  /manage                    AllController@manage
  GET  /create/data               AllController@create
  POST /create/action/data        AllController@action
  GET  /qrcode/{id}               AllController@qrCode
  POST /reset-telat               AllController@reset

Major Management:
  GET  /jurusan/manage            jurusanController@jurusan
  POST /jurusan/manage/action     jurusanController@actionJurusan
  GET  /jurusan/update/{id}       jurusanController@update
  POST /jurusan/update/where/{id} jurusanController@jurusanUpdate
  DELETE /jurusan/delete/{id}     jurusanController@delete

Class Management:
  GET  /kelas/manage              kelasController@kelas
  POST /kelas/manage/action       kelasController@actionKelas
  GET  /kelas/update/{id}         kelasController@update
  POST /kelas/update/where/{id}   kelasController@kelasUpdate
  DELETE /kelas/delete/{id}       kelasController@delete

QR Scan & Lateness:
  GET  /qrcode/scan               QrController@qrscan
  GET  /Scan/Siswa                QrController@scanSiswa
  POST /qrscan/action             QrController@scanacti
  GET  /qrscan/lateSiswa          QrController@lateTable

8. CONTROLLERS & KEY METHODS
-----------------------------

AllController:
  index()        - Shows welcome page with current date
  dash()         - Dashboard with stats + weekly bar chart
  manage()       - All students DataTable view
  create()       - New student form
  action()       - Store student record
  qrCode($id)    - Show student's QR code
  reset()        - Reset Telat counter to 0 for all students
  dashCreate()   - Create user form
  dashCreateAction() - Store new user
  dashUpdate($id)    - Edit user form
  dashUpdateAction($id) - Process user update
  dashDelete($id)    - Delete user

LoginController:
  login()        - Login form
  actionLogin()  - Authenticate (name + password via Auth::attempt)
  logout()       - Logout + session invalidation

jurusanController:
  jurusan()      - DataTable + create form
  actionJurusan()- Store new major
  update($id)    - Update form
  jurusanUpdate($id) - Process update
  delete($id)    - Delete major

kelasController:
  kelas()        - DataTable + create form
  actionKelas()  - Store new class
  update($id)    - Update form
  kelasUpdate($id) - Process update
  delete($id)    - Delete class

QrController:
  qrscan()       - QR scan page
  scanacti()     - Process QR scan: lookup NISN, record lateness
  lateTable()    - Late students table
  scanSiswa()    - QR scanner view

9. VIEW STRUCTURE
-----------------
template/master.blade.php (Layout)
  template/header.blade.php    (AdminLTE sidebar, navbar)
  template/footer.blade.php    (Scripts: jQuery, Bootstrap, Chart.js, DataTables)

Views extending master:
  content/home.blade.php           - Welcome page
  content/manage.blade.php         - Student datatable
  content/create.blade.php         - Add student form (multi-step)
  content/jurusan/jurusan.blade.php - Majors management
  content/kelas/kelas.blade.php    - Classes management
  content/qrScan/qrcode.blade.php  - Student QR code display
  content/qrScan/scanSiswa.blade.php - QR scanner
  content/qrScan/lateTable.blade.php - Late students table
  admin/dash.blade.php             - Dashboard with chart

Standalone views:
  Login/login.blade.php            - Login page
  admin/create.blade.php           - Create user
  admin/update.blade.php           - Update user
  content/jurusan/update.blade.php - Update major
  content/kelas/update.blade.php   - Update class
  content/test.blade.php           - Test/demo page
  404/404universal.blade.php       - 404 error page

10. LATENESS RECORDING FLOW
----------------------------
1. Student shows QR code (generated from their NISN)
2. Operator scans QR code using html5-qrcode in scanSiswa.blade.php
3. System looks up NISN in datasiswa table
4. If not already recorded late today, creates keterlambatan record
5. Increments Telat counter on datasiswa record
6. lateTable.blade.php displays students with Telat >= 1

11. SCHEDULED TASKS
--------------------
Console Kernel defines a yearly task:
  - Increment kelas_id for students where kelas_id < 3
    (auto-promotion to next grade level)
  - References ResetTelatHourly command (file does not exist)

12. KNOWN ISSUES / TECHNICAL DEBT
----------------------------------
- Redundant `role` string column on users table
- Unused role_user pivot table
- Unused CheckRole middleware
- Mixed Bootstrap 4 (AdminLTE) and Bootstrap 5 (standalone pages)
- ResetTelatHourly artisan command referenced but not created
- yajra/laravel-datatables installed but not used (client-side DataTables instead)
- No test coverage beyond skeleton tests
- .env file not in repo (expected)
- Scheduled task references non-existent command
- admins table appears unused by the application
- qrscan.blade.php is entirely commented out
- Error/404 route commented out
