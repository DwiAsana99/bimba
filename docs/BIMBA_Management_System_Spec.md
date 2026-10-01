# BIMBA Management System --- Software Specification

## 1. Project Overview

**Project Name:** BIMBA Management System\
**Purpose:** Sistem manajemen operasional tempat les BIMBA berbasis
multi-cabang.

### Technology Stack

-   Backend: PHP Laravel
-   Frontend: Blade + Tailwind CSS + DaisyUI
-   JavaScript enhancement: Alpine.js
-   Database: MySQL
-   Authentication: Laravel authentication
-   Authorization: Role & permission berbasis policy/middleware
-   Queue: Laravel Queue
-   Scheduler: Laravel Scheduler
-   Reporting: PDF/Excel
-   Notification: Database notification, dengan opsi integrasi WhatsApp
    pada fase lanjutan

### Design System

Brand mengikuti Brand Guideline INSTIKI:

  Token         HEX         Penggunaan
  ------------- ----------- ---------------------
  Maroon        `#A20404`   Primary
  Strawberry    `#FF0100`   Danger / accent
  Golden Hour   `#FFAD01`   Warning / highlight
  Navy Blue     `#192A54`   Secondary / text
  Black         `#000000`   Text
  White         `#FFFFFF`   Background
  Font          Inter       Typography

Brand guideline menetapkan Inter sebagai brand typeface dan menyediakan
palette Maroon, Strawberry, Golden Hour, Navy Blue, Black, dan White.
Logo horizontal digunakan ketika logo ditempatkan pada pojok kiri/kanan.
Minimum tinggi logo adalah 85 px. Gunakan aset logo resmi yang diberikan
proyek, bukan membuat ulang logo.

> Catatan: Brand guideline juga menyatakan bahwa contoh photographic
> mockup di dalam guideline tidak boleh digunakan sebagai aset
> komunikasi publik tanpa izin. Untuk aplikasi, gunakan aset logo resmi
> dan elemen brand yang relevan.

------------------------------------------------------------------------

# 2. Objectives

Sistem harus:

1.  Mengelola banyak cabang BIMBA.
2.  Mengelola guru berdasarkan cabang.
3.  Mengelola murid berdasarkan cabang.
4.  Mengelola orang tua/wali murid.
5.  Mengelola kelas.
6.  Menghubungkan guru, kelas, dan murid.
7.  Mengelola tarif pendidikan.
8.  Menghasilkan tagihan bulanan siswa.
9.  Mencatat pembayaran siswa.
10. Menampilkan siswa yang belum membayar.
11. Mengubah tagihan menjadi overdue setelah melewati jatuh tempo.
12. Memberikan reminder pembayaran.
13. Menyediakan dashboard berdasarkan role.
14. Menyediakan laporan.
15. Menyediakan audit trail untuk transaksi penting.
16. Menjamin admin cabang hanya dapat mengakses data cabangnya.

------------------------------------------------------------------------

# 3. Scope MVP

## 3.1 Included

### Authentication & Authorization

-   Login/logout
-   User management
-   Role management
-   Branch-based authorization
-   Policy/middleware authorization

### Branch Management

-   CRUD cabang
-   Status cabang
-   Informasi kontak
-   Manager/kepala cabang

### Teacher Management

-   CRUD guru
-   Relasi guru ke cabang
-   Status aktif/nonaktif
-   Akun user guru

### Parent Management

-   CRUD orang tua/wali
-   Kontak
-   Relasi satu orang tua dengan banyak murid

### Student Management

-   CRUD murid
-   Nomor induk
-   Biodata
-   Relasi orang tua
-   Relasi cabang
-   Status murid
-   Riwayat perpindahan cabang

### Class Management

-   CRUD kelas
-   Cabang
-   Guru
-   Murid
-   Status kelas
-   Jadwal dasar

### Fee Management

-   Master tarif
-   Tarif dapat dikaitkan dengan cabang/program
-   Status tarif

### Billing

-   Generate tagihan bulanan
-   Nomor invoice
-   Periode tagihan
-   Tanggal terbit
-   Jatuh tempo
-   Nominal
-   Status tagihan

### Payment

-   Pencatatan pembayaran
-   Pembayaran penuh
-   Pembayaran sebagian jika diperlukan
-   Metode pembayaran
-   Nomor transaksi
-   Bukti/receipt
-   Riwayat pembayaran

### Outstanding / Overdue

-   Daftar tagihan belum lunas
-   Daftar overdue
-   Total tunggakan
-   Filter cabang/periode/status

### Notification

-   Notifikasi pembayaran pada dashboard
-   Reminder sebelum jatuh tempo
-   Reminder setelah jatuh tempo
-   Riwayat notifikasi

### Reporting

-   Laporan pembayaran
-   Laporan tunggakan
-   Laporan siswa
-   Laporan guru
-   Laporan per cabang
-   Export Excel/PDF

### Audit Log

-   Login penting
-   Perubahan data penting
-   Perubahan transaksi pembayaran
-   Penghapusan/void transaksi

------------------------------------------------------------------------

# 4. Roles

## 4.1 Super Admin

Access: - Semua cabang - Semua master data - Semua transaksi - Semua
laporan - User & role - System settings - Audit log

## 4.2 Branch Admin

Access: - Hanya satu cabang - Guru cabang - Murid cabang - Orang tua
cabang - Kelas cabang - Tagihan cabang - Pembayaran cabang - Laporan
cabang

Tidak boleh: - Mengakses data cabang lain - Mengubah konfigurasi
global - Mengelola Super Admin

## 4.3 Branch Manager

Access: - Dashboard cabang - Guru - Murid - Kelas - Pembayaran -
Tunggakan - Laporan

Default-nya read-oriented, kecuali permission tertentu diberikan.

## 4.4 Teacher

Access: - Profil sendiri - Kelas yang diampu - Murid dalam kelas -
Jadwal - Absensi/catatan perkembangan jika modul tersebut diaktifkan

Teacher tidak memiliki akses transaksi keuangan kecuali permission
khusus.

------------------------------------------------------------------------

# 5. Core Business Rules

## 5.1 Branch Isolation

Setiap entity operasional yang berkaitan dengan cabang harus dapat
ditelusuri ke `branch_id`.

Minimal: - teachers - students - classrooms - invoices - payments
melalui invoice - fee configurations jika tarif berbeda per cabang

Admin cabang hanya dapat membaca/mengubah data dengan `branch_id` yang
sama.

Authorization wajib dilakukan pada backend, bukan hanya frontend.

------------------------------------------------------------------------

## 5.2 Student Status

Allowed status:

-   `active`
-   `leave`
-   `graduated`
-   `inactive`

Murid inactive/graduated tidak boleh otomatis menerima tagihan baru.

------------------------------------------------------------------------

## 5.3 Teacher Status

Allowed status:

-   `active`
-   `inactive`

------------------------------------------------------------------------

## 5.4 Invoice Status

Allowed status:

-   `unpaid`
-   `partial`
-   `paid`
-   `overdue`
-   `cancelled`

### Rules

-   `unpaid`: belum ada pembayaran.
-   `partial`: pembayaran \> 0 tetapi belum mencapai total.
-   `paid`: total pembayaran \>= total invoice.
-   `overdue`: tanggal sekarang \> due date dan invoice belum paid.
-   `cancelled`: invoice dibatalkan dan tidak boleh menerima pembayaran
    baru.

------------------------------------------------------------------------

## 5.5 Monthly Billing

Sistem menggunakan satu periode tagihan per bulan.

Recommended representation:

``` text
billing_period = 2026-10-01
```

Unique constraint:

``` text
student_id + billing_period
```

Tujuannya mencegah invoice ganda untuk murid dan periode yang sama.

------------------------------------------------------------------------

## 5.6 Payment Rules

-   Payment hanya dapat dibuat untuk invoice yang valid.
-   Payment tidak boleh melebihi outstanding amount, kecuali sistem
    secara eksplisit mendukung overpayment.
-   Invoice `cancelled` tidak dapat menerima payment.
-   Setelah payment berhasil dicatat, status invoice dihitung ulang.
-   Setiap perubahan payment harus tercatat dalam audit log.

------------------------------------------------------------------------

## 5.7 Due Date

Due date dapat dikonfigurasi pada level: - global, - cabang, - atau
student/fee configuration,

tetapi MVP sebaiknya memilih satu mekanisme yang konsisten agar
implementasi tidak kompleks.

Jika belum ada keputusan bisnis final, gunakan **due day per fee
configuration/cabang** sebagai desain yang mudah dikembangkan.

------------------------------------------------------------------------

# 6. Data Model

## 6.1 Core Tables

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

Optional/future:

``` text
student_branch_histories
attendance
student_notes
whatsapp_messages
payment_receipts
```

------------------------------------------------------------------------

# 7. Suggested Schema

## branches

``` text
id
code
name
address
city
phone
email
manager_name
status
created_at
updated_at
```

Constraints: - `code` unique.

## users

``` text
id
name
email
password
branch_id nullable
status
last_login_at nullable
remember_token
created_at
updated_at
```

Super Admin dapat memiliki `branch_id = null`.

## teachers

``` text
id
branch_id
user_id nullable
employee_number
nik nullable
name
gender
birth_date nullable
phone
email nullable
address nullable
education nullable
join_date nullable
status
created_at
updated_at
```

Constraints: - `employee_number` unique. - `branch_id` foreign key.

## parents

``` text
id
branch_id
name
phone
email nullable
address nullable
occupation nullable
notes nullable
created_at
updated_at
```

## students

``` text
id
branch_id
parent_id nullable
student_number
name
nickname nullable
gender
birth_date nullable
address nullable
join_date
program nullable
status
notes nullable
created_at
updated_at
```

Constraints: - `student_number` unique.

## classrooms

``` text
id
branch_id
code
name
capacity nullable
day_of_week nullable
start_time nullable
end_time nullable
status
created_at
updated_at
```

## classroom_teacher

``` text
classroom_id
teacher_id
```

## classroom_student

``` text
classroom_id
student_id
joined_at
left_at nullable
status
```

## fee_types

``` text
id
code
name
description nullable
status
created_at
updated_at
```

## fee_configurations

``` text
id
branch_id nullable
fee_type_id
name
amount
due_day
effective_from
effective_until nullable
status
created_at
updated_at
```

## invoices

``` text
id
invoice_number
branch_id
student_id
billing_period
issue_date
due_date
total_amount
paid_amount
status
notes nullable
created_at
updated_at
```

Constraints: - `invoice_number` unique. - Unique composite:
`student_id + billing_period`.

## invoice_items

``` text
id
invoice_id
description
qty
unit_price
amount
created_at
updated_at
```

## payments

``` text
id
invoice_id
payment_number
payment_date
amount
payment_method_id
received_by
reference_number nullable
notes nullable
created_at
updated_at
```

## payment_methods

``` text
id
code
name
status
created_at
updated_at
```

Examples: - CASH - TRANSFER - QRIS - EDC

## notifications

Use Laravel notification structure where practical.

Business fields may include:

``` text
id
branch_id
student_id nullable
invoice_id nullable
type
title
message
read_at nullable
created_at
updated_at
```

## audit_logs

``` text
id
user_id nullable
branch_id nullable
action
auditable_type
auditable_id
old_values nullable
new_values nullable
ip_address nullable
user_agent nullable
created_at
```

------------------------------------------------------------------------

# 8. Application Navigation

``` text
Dashboard

MASTER DATA
├── Cabang
├── Guru
├── Orang Tua
├── Murid
├── Kelas
└── Tarif

KEUANGAN
├── Tagihan
├── Pembayaran
├── Tunggakan
└── Metode Pembayaran

NOTIFIKASI
└── Reminder Pembayaran

LAPORAN
├── Murid
├── Guru
├── Pembayaran
├── Tunggakan
└── Pendapatan

SYSTEM
├── User
├── Role & Permission
├── Pengaturan
└── Audit Log
```

------------------------------------------------------------------------

# 9. Dashboard Requirements

## Super Admin

Display: - total branches - active teachers - active students - current
month billing - current month collected - outstanding amount - overdue
student count - overdue invoice count - payment trend - payment summary
by branch - recent payments

## Branch Admin / Manager

Display: - active students - active teachers - active classes - current
billing - collected amount - outstanding amount - overdue amount -
unpaid student count - recent payments - upcoming due invoices

------------------------------------------------------------------------

# 10. Billing Workflow

``` text
Active Student
      ↓
Active Fee Configuration
      ↓
Generate Monthly Invoice
      ↓
UNPAID
      ↓
Payment
      ↓
PARTIAL / PAID
      ↓
If due date passed and not paid
      ↓
OVERDUE
      ↓
Reminder
```

------------------------------------------------------------------------

# 11. Automated Jobs

Use Laravel Scheduler.

Required jobs:

### Generate Monthly Invoices

-   Generate invoices for active students.
-   Must be idempotent.
-   Never create duplicate invoice for same student and billing period.

### Update Overdue Invoices

-   Find unpaid/partial invoices past due date.
-   Change status to overdue.

### Payment Reminder

-   Find upcoming due invoices.
-   Find overdue invoices according to reminder rules.
-   Create database notifications.

Scheduler must be safe to run repeatedly.

------------------------------------------------------------------------

# 12. UI/UX Requirements

Use: - Tailwind CSS - DaisyUI - Inter font - Responsive layout - Sidebar
navigation - Topbar - Breadcrumb - Cards - Tables - Modal/drawer for
simple forms - Dedicated pages for complex forms - Toast/alert
feedback - Confirmation modal for destructive actions

### Color usage

Do not make the entire application red.

Recommended: - Background: white/light neutral - Sidebar: Navy Blue -
Primary action: Maroon - Warning: Golden Hour - Danger: Strawberry -
Text: Navy/Black - Success: standard semantic green if needed for
accessibility

Brand color should support usability, not replace semantic meaning.

------------------------------------------------------------------------

# 13. Logo Rules

Use official horizontal INSTIKI logo asset supplied by the project.

When positioned in the upper-left area, use horizontal logo.

Maintain clear space according to brand guideline.

Do not: - stretch logo - rotate logo - recolor the logo arbitrarily -
add drop shadow - apply gradient - distort logogram

The brand guideline specifies horizontal logo usage for page corners and
a minimum logo height of 85 px. fileciteturn0file0L107-L153

------------------------------------------------------------------------

# 14. Security Requirements

-   CSRF protection
-   Password hashing
-   Authorization at backend
-   Branch isolation
-   Form Request validation
-   Mass assignment protection
-   SQL injection protection through Eloquent/query builder
-   Rate limiting for authentication
-   Audit logging for financial changes
-   Do not expose sensitive internal IDs unnecessarily
-   Secure file upload if receipt upload is implemented
-   Never trust `branch_id` sent by the browser for branch-scoped users

------------------------------------------------------------------------

# 15. Coding Standards

-   Follow Laravel conventions.
-   Use Form Requests for validation.
-   Use Policies/Gates for authorization.
-   Use Services for complex business logic.
-   Use database transactions for financial operations.
-   Use enums where useful for status values.
-   Use migrations for every schema change.
-   Use seeders/factories for development data.
-   Use named routes.
-   Avoid business logic in Blade templates.
-   Avoid massive controllers.
-   Use eager loading to avoid N+1 queries.
-   Add indexes for foreign keys and common filtering columns.

------------------------------------------------------------------------

# 16. Testing Requirements

Minimum tests:

### Authentication

-   login
-   logout
-   unauthorized access

### Branch isolation

-   branch admin cannot access other branch
-   super admin can access all branches

### Students

-   CRUD
-   validation
-   duplicate student number

### Billing

-   invoice generation
-   duplicate prevention
-   status calculation

### Payments

-   valid payment
-   partial payment
-   full payment
-   overpayment rejection
-   cancelled invoice rejection

### Overdue

-   invoice changes to overdue after due date
-   paid invoice never becomes overdue

### Authorization

-   role permissions
-   policy tests

------------------------------------------------------------------------

# 17. Acceptance Criteria

The MVP is accepted when:

1.  Super Admin can create/manage branches.
2.  Branch Admin can only see its branch.
3.  Teachers can be managed by branch.
4.  Students can be managed by branch.
5.  Parent-student relation works.
6.  Classes can be managed.
7.  Active students can receive monthly invoices.
8.  Duplicate invoices are prevented.
9.  Payments can be recorded.
10. Invoice status updates correctly.
11. Overdue invoices are detected.
12. Dashboard displays outstanding payments.
13. Payment reminders can be generated.
14. Reports can be filtered by branch and period.
15. Financial changes are audited.
16. Core automated tests pass.
17. Application runs locally using documented setup instructions.

------------------------------------------------------------------------

# 18. Definition of Done

A feature is complete only when:

-   migration exists
-   model exists
-   validation exists
-   authorization exists
-   UI exists
-   empty state exists
-   success/error feedback exists
-   tests exist
-   seed/factory exists where appropriate
-   code is formatted
-   no obvious N+1 query exists
-   branch isolation is verified
-   documentation is updated
