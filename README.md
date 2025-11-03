# Student Late Attendance System

A web-based attendance system used to record and manage student lateness.  
This application provides QR-based attendance scanning and role-based management to organize student data and track weekly lateness.

---

## 🚀 Features

### ✅ Late Attendance Tracking
- Scan student QR codes to record lateness
- View students who have been late within the last **7 days**

### 👥 User Roles & Permissions
| Role | Permissions |
|------|-------------|
| Admin | Full access and system control |
| Operator | Manage attendance & student-related features |

> Certain features are exclusively available for **Operator** role to support workflow separation.

### 🧑‍🎓 Student Management
- CRUD student data
- Automatically generated **QR Code** for each student

### 🏫 Class & Major Management
- CRUD **Classes**
- CRUD **Majors**

### 📷 QR Code System
- QR code generation per student
- QR scanner to record lateness instantly

---

## 🛠 Tech Stack

| Component | Technology |
|----------|------------|
| Framework | **Laravel** |
| Database | MySQL / MariaDB |
| Authentication | Laravel Auth + Role Middleware |
| QR Features | QR Generator / Scanner libraries |

## License
This project is licensed under the MIT License — see the [LICENSE](./LICENSE) file for details.

Developed by Me.
