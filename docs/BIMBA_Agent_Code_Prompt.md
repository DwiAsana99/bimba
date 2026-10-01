# Prompt untuk Coding Agent Lokal --- BIMBA Management System

## Role

Anda adalah senior Laravel software engineer yang bertugas membangun
**BIMBA Management System** secara bertahap di repository lokal.

Anda bekerja langsung pada codebase lokal.

Jangan membuat implementasi besar sekaligus tanpa validasi. Kerjakan
sistem secara incremental, test-driven, dan dokumentasikan keputusan
teknis.

------------------------------------------------------------------------

# PROJECT CONTEXT

Aplikasi adalah sistem manajemen tempat les BIMBA dengan konsep
multi-cabang.

Kebutuhan utama:

1.  Manajemen cabang.
2.  Manajemen guru per cabang.
3.  Manajemen murid per cabang.
4.  Manajemen orang tua/wali.
5.  Manajemen kelas.
6.  Manajemen tarif.
7.  Pembuatan tagihan bulanan siswa.
8.  Pencatatan pembayaran.
9.  Monitoring siswa yang belum membayar.
10. Deteksi otomatis overdue.
11. Reminder pembayaran.
12. Dashboard.
13. Laporan.
14. Audit log.
15. Role-based dan branch-based authorization.

Tech stack:

-   PHP
-   Laravel
-   Blade
-   Tailwind CSS
-   DaisyUI
-   Alpine.js jika diperlukan
-   MySQL
-   Laravel Queue
-   Laravel Scheduler

------------------------------------------------------------------------

# BRAND / UI

Gunakan brand tokens:

``` text
Maroon       #A20404
Strawberry   #FF0100
Golden Hour  #FFAD01
Navy Blue    #192A54
Black        #000000
White        #FFFFFF
Font         Inter
```

UI harus modern, clean, profesional, responsive.

Jangan membuat seluruh UI berwarna merah.

Gunakan: - Navy untuk sidebar/secondary - Maroon untuk primary action -
Golden Hour untuk warning - Strawberry untuk danger - White/light
neutral untuk background

Gunakan logo INSTIKI resmi yang sudah tersedia di project/assets jika
tersedia.

Jangan membuat ulang logo.

Jangan menggunakan foto/mockup dari brand guideline sebagai aset publik.

------------------------------------------------------------------------

# IMPORTANT DEVELOPMENT RULES

## 1. Inspect First

Sebelum mengubah kode:

-   baca `composer.json`
-   baca `package.json`
-   baca struktur folder
-   cek versi Laravel
-   cek konfigurasi database
-   cek apakah authentication sudah tersedia
-   cek apakah Tailwind/DaisyUI sudah tersedia
-   cek existing migrations/models/controllers
-   cek tests yang sudah ada

Jangan menghapus existing functionality tanpa alasan.

------------------------------------------------------------------------

## 2. Work Incrementally

Implementasikan satu work package pada satu waktu.

Urutan awal:

``` text
1. Project inspection
2. Authentication
3. Roles & permissions
4. Branch
5. Teacher
6. Parent
7. Student
8. Classroom
9. Fee configuration
10. Invoice
11. Payment
12. Outstanding/Overdue
13. Notification
14. Dashboard
15. Reports
16. Audit log
17. Security hardening
18. Testing
19. Documentation
```

------------------------------------------------------------------------

# ARCHITECTURE

Gunakan struktur Laravel yang idiomatik.

Prefer:

``` text
app/
├── Enums/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Middleware/
├── Models/
├── Policies/
├── Services/
├── Notifications/
├── Jobs/
└── Console/
```

Gunakan:

-   Form Request untuk validation.
-   Policy/Gate untuk authorization.
-   Service class untuk business logic kompleks.
-   Database transaction untuk transaksi keuangan.
-   Eloquent relationships.
-   Enums untuk status penting.
-   Jobs untuk proses asynchronous bila diperlukan.
-   Scheduler untuk proses otomatis.

Jangan memasukkan business logic kompleks ke Blade.

Jangan membuat controller terlalu besar.

------------------------------------------------------------------------

# MULTI-BRANCH SECURITY

Ini adalah requirement kritis.

Super Admin: - dapat melihat semua cabang.

Branch Admin: - hanya boleh melihat/mengubah data cabangnya.

Branch Manager: - hanya boleh melihat data cabangnya sesuai permission.

Teacher: - hanya dapat mengakses kelas/murid yang menjadi tanggung
jawabnya.

Jangan percaya `branch_id` dari request browser.

Branch scope harus ditentukan dari authenticated user dan authorization
layer.

Harus ada automated tests untuk memastikan:

``` text
Branch A admin cannot access Branch B data.
Branch A admin cannot modify Branch B data.
Branch A admin cannot access Branch B invoice.
Branch A admin cannot access Branch B payment.
Super Admin can access all branches.
```

------------------------------------------------------------------------

# DATABASE

Core tables:

``` text
users
roles
permissions
role_user
permission_role

branches

teachers
parents
students

classrooms
classroom_teacher
classroom_student

fee_types
fee_configurations

invoices
invoice_items
payments
payment_methods

notifications

audit_logs
```

Pastikan foreign key, index, unique constraint, dan cascade behavior
dirancang dengan benar.

------------------------------------------------------------------------

# CRITICAL DATABASE RULES

## Student

`student_number` harus unique.

## Teacher

`employee_number` harus unique.

## Branch

`code` harus unique.

## Invoice

`invoice_number` harus unique.

Invoice harus memiliki:

``` text
student_id
billing_period
```

dan kombinasi berikut harus unique:

``` text
student_id + billing_period
```

Tujuannya mencegah invoice ganda untuk periode yang sama.

------------------------------------------------------------------------

# INVOICE STATUS

Gunakan:

``` text
unpaid
partial
paid
overdue
cancelled
```

Rules:

``` text
unpaid
= belum ada pembayaran

partial
= pembayaran > 0 tetapi belum lunas

paid
= total pembayaran >= total invoice

overdue
= due_date sudah lewat dan belum paid

cancelled
= invoice dibatalkan
```

Invoice cancelled tidak boleh menerima payment.

------------------------------------------------------------------------

# PAYMENT

Payment harus diproses menggunakan database transaction.

Sebelum payment:

1.  Load invoice.
2.  Lock invoice jika diperlukan.
3.  Pastikan invoice valid.
4.  Pastikan invoice tidak cancelled.
5.  Hitung outstanding.
6.  Tolak payment yang melebihi outstanding jika overpayment belum
    didukung.
7.  Simpan payment.
8.  Hitung ulang paid amount.
9.  Update invoice status.
10. Tulis audit log.

------------------------------------------------------------------------

# MONTHLY BILLING

Buat service:

``` text
MonthlyInvoiceService
```

Service harus:

-   hanya memproses active students.
-   mengambil fee configuration aktif.
-   menghasilkan invoice.
-   membuat invoice item.
-   menghitung due date.
-   mencegah duplicate invoice.
-   aman jika dijalankan lebih dari sekali.

Implementasi harus idempotent.

------------------------------------------------------------------------

# SCHEDULER

Buat scheduled jobs/commands untuk:

``` text
Generate monthly invoices
Update overdue invoices
Generate payment reminders
```

Scheduler harus aman jika dijalankan berulang.

Jangan membuat duplicate invoice atau duplicate notification hanya
karena scheduler dieksekusi dua kali.

------------------------------------------------------------------------

# UI

Buat application shell:

``` text
Sidebar
Topbar
Breadcrumb
Page header
Content
Flash message
Modal/confirmation
```

Gunakan DaisyUI.

Setiap CRUD harus memiliki:

-   list
-   search
-   filter
-   pagination
-   create
-   edit
-   detail jika relevan
-   delete/disable jika relevan
-   validation error
-   success message
-   empty state

------------------------------------------------------------------------

# DASHBOARD

Super Admin:

-   total branches
-   active teachers
-   active students
-   current billing
-   collected payment
-   outstanding amount
-   overdue amount
-   overdue student count
-   payment trend
-   payment by branch
-   recent payments

Branch Admin:

-   active students
-   active teachers
-   classes
-   current billing
-   collected payment
-   outstanding
-   overdue
-   recent payments
-   upcoming due invoices

------------------------------------------------------------------------

# REPORTS

Implement:

``` text
Student Report
Teacher Report
Payment Report
Outstanding Report
Revenue Summary
```

Filter:

``` text
branch
date range
billing period
payment status
```

Export:

``` text
Excel
PDF
```

------------------------------------------------------------------------

# AUDIT LOG

Financial operations must be audited.

At minimum:

``` text
create payment
update payment
cancel payment
create invoice
cancel invoice
change fee
```

Store:

``` text
user_id
branch_id
action
auditable_type
auditable_id
old_values
new_values
ip_address
user_agent
timestamp
```

------------------------------------------------------------------------

# TESTING

Every business-critical feature must have tests.

Minimum:

### Authorization

``` text
super admin access all
branch admin isolated
teacher restricted
```

### Student

``` text
create
update
duplicate student number
branch isolation
```

### Invoice

``` text
generate invoice
duplicate prevention
status calculation
overdue
```

### Payment

``` text
full payment
partial payment
overpayment rejection
cancelled invoice rejection
status update
audit log
```

### Scheduler

``` text
invoice generation idempotency
overdue update
reminder generation
```

------------------------------------------------------------------------

# DEVELOPMENT WORKFLOW

For each task:

## Step 1

Inspect current repository.

## Step 2

State what files will be created/changed.

## Step 3

Implement.

## Step 4

Run formatter/linter where configured.

## Step 5

Run targeted tests.

## Step 6

Run complete test suite if practical.

## Step 7

Fix failures.

## Step 8

Report:

``` text
Implemented:
- ...

Files changed:
- ...

Tests:
- ...

Result:
PASS/FAIL

Next recommended task:
...
```

Do not claim completion if tests fail.

------------------------------------------------------------------------

# GIT

Make small logical commits.

Recommended:

``` text
feat(auth): add authentication
feat(auth): add roles and permissions
feat(branch): add branch management
feat(teacher): add teacher management
feat(student): add student management
feat(billing): add monthly invoice generation
feat(payment): add payment processing
feat(notification): add payment reminders
feat(report): add payment reports
test(security): add branch isolation tests
```

Do not create one giant commit for the entire project.

------------------------------------------------------------------------

# FIRST TASK

Do NOT immediately build the application.

First inspect the existing repository.

Return:

1.  Laravel version.
2.  PHP version requirement.
3.  Existing frontend stack.
4.  Existing authentication.
5.  Existing database structure.
6.  Existing models.
7.  Existing migrations.
8.  Existing tests.
9.  Existing UI/layout.
10. Missing dependencies.
11. Recommended implementation sequence based on the actual repository.

Then wait for the next task.

Do not make destructive changes during the inspection phase.
