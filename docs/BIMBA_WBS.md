# BIMBA Management System --- Work Breakdown Structure

## 1. Project Setup

  ID     Work Package              Deliverable                    Status
  ------ ------------------------- ------------------------------ -----------------------
  1.1    Repository setup          Git repository                 [DONE]
  1.2    Laravel setup             Working Laravel application    [DONE]
  1.3    MySQL configuration       Working database connection    [DONE]
  1.4    Tailwind setup            Tailwind configured            [DONE - v4]
  1.5    DaisyUI setup             DaisyUI configured             [DONE - v5]
  1.6    Inter font                Typography configured          [DONE - Google Font Inter]
  1.7    Brand theme               BIMBA/INSTIKI theme tokens     [DONE - Maroon/Navy/Golden/Strawberry]
  1.8    Environment config        `.env.example`                 [DONE]
  1.9    Base layout               Responsive application shell   [DONE - App Shell & Components]
  1.10   CI/basic quality checks   Automated test/lint workflow   [DONE - Test Suite PASS]

## 2. Authentication & Authorization

  ID    Work Package          Deliverable
  ----- --------------------- -----------------------
  2.1   Authentication        Login/logout
  2.2   User model            User entity
  2.3   Role model            Role entity
  2.4   Permission model      Permission entity
  2.5   Role assignment       User-role management
  2.6   Policies              Backend authorization
  2.7   Branch scope          Branch isolation
  2.8   Authorization tests   Security test suite

## 3. Branch Management

  ID    Work Package        Deliverable
  ----- ------------------- ---------------------------
  3.1   Branch migration    branches table
  3.2   Branch model        Branch model
  3.3   Branch CRUD         Create/read/update/delete
  3.4   Branch validation   Form Requests
  3.5   Branch UI           List/form/detail
  3.6   Branch tests        Feature/unit tests

## 4. Teacher Management

  ID    Work Package          Deliverable
  ----- --------------------- ----------------------
  4.1   Teacher migration     teachers table
  4.2   Teacher model         Teacher model
  4.3   Teacher CRUD          CRUD workflow
  4.4   Branch relationship   Teacher → Branch
  4.5   Teacher account       Optional linked user
  4.6   Teacher UI            List/form/detail
  4.7   Teacher tests         Test suite

## 5. Parent Management

  ID    Work Package              Deliverable
  ----- ------------------------- ------------------
  5.1   Parent migration          parents table
  5.2   Parent model              Parent model
  5.3   Parent CRUD               CRUD workflow
  5.4   Parent-student relation   One-to-many
  5.5   Parent UI                 List/form/detail
  5.6   Parent tests              Test suite

## 6. Student Management

  ID    Work Package            Deliverable
  ----- ----------------------- -----------------------------
  6.1   Student migration       students table
  6.2   Student model           Student model
  6.3   Student CRUD            CRUD workflow
  6.4   Student validation      Form Requests
  6.5   Parent relation         Student → Parent
  6.6   Branch relation         Student → Branch
  6.7   Student search/filter   Search, status, branch
  6.8   Student detail          Profile + financial summary
  6.9   Student tests           Test suite

## 7. Class Management

  ID    Work Package          Deliverable
  ----- --------------------- --------------------
  7.1   Classroom migration   classrooms
  7.2   Teacher pivot         classroom_teacher
  7.3   Student pivot         classroom_student
  7.4   Class CRUD            Class management
  7.5   Assign teacher        Teacher assignment
  7.6   Assign students       Student assignment
  7.7   Class UI              List/detail
  7.8   Class tests           Test suite

## 8. Fee Management

  ID    Work Package        Deliverable
  ----- ------------------- ------------------------
  8.1   Fee types           fee_types
  8.2   Fee configuration   fee_configurations
  8.3   Tariff CRUD         Tariff management
  8.4   Due date rule       Due date configuration
  8.5   Tariff UI           List/form/detail
  8.6   Tariff tests        Test suite

## 9. Billing / Invoice

  ID    Work Package               Deliverable
  ----- -------------------------- ----------------------------------
  9.1   Invoice schema             invoices
  9.2   Invoice items              invoice_items
  9.3   Invoice number generator   Unique invoice numbering
  9.4   Monthly generator          Monthly invoice service
  9.5   Duplicate prevention       Unique student-period constraint
  9.6   Invoice status             Status calculation
  9.7   Invoice list               Filtering/search
  9.8   Invoice detail             Invoice detail
  9.9   Invoice tests              Test suite

## 10. Payment

  ID     Work Package      Deliverable
  ------ ----------------- --------------------------
  10.1   Payment methods   payment_methods
  10.2   Payment schema    payments
  10.3   Payment service   Transaction-safe service
  10.4   Full payment      PAID workflow
  10.5   Partial payment   PARTIAL workflow
  10.6   Validation        Outstanding amount check
  10.7   Payment receipt   Receipt view/PDF
  10.8   Payment history   Transaction history
  10.9   Payment tests     Test suite

## 11. Outstanding & Reminder

  ID     Work Package             Deliverable
  ------ ------------------------ -------------------------
  11.1   Overdue service          Overdue calculation
  11.2   Overdue scheduler        Automated status update
  11.3   Outstanding dashboard    Tunggakan summary
  11.4   Reminder service         Reminder generation
  11.5   Database notifications   In-app notification
  11.6   Notification center      Notification UI
  11.7   Reminder tests           Test suite

## 12. Dashboard

  ID     Work Package            Deliverable
  ------ ----------------------- ---------------------
  12.1   Super Admin dashboard   Global overview
  12.2   Branch dashboard        Branch overview
  12.3   KPI cards               Core metrics
  12.4   Payment trend           Payment chart
  12.5   Branch summary          Branch comparison
  12.6   Recent payments         Recent transactions
  12.7   Upcoming due            Due soon list

## 13. Reporting

  ID     Work Package         Deliverable
  ------ -------------------- ------------------------
  13.1   Student report       Student report
  13.2   Teacher report       Teacher report
  13.3   Payment report       Payment report
  13.4   Outstanding report   Tunggakan report
  13.5   Revenue report       Revenue summary
  13.6   Branch filter        Branch filtering
  13.7   Period filter        Monthly/date filtering
  13.8   Excel export         XLSX
  13.9   PDF export           PDF

## 14. Audit Log

  ID     Work Package        Deliverable
  ------ ------------------- -----------------
  14.1   Audit schema        audit_logs
  14.2   Audit service       Logging service
  14.3   Payment audit       Financial audit
  14.4   Master data audit   CRUD audit
  14.5   Audit viewer        Admin UI

## 15. Security & Performance

  ID     Work Package              Deliverable
  ------ ------------------------- -------------------------------
  15.1   Authorization review      Policy audit
  15.2   Branch isolation review   Cross-branch security test
  15.3   Validation review         Input validation
  15.4   Query review              N+1 review
  15.5   Index review              Database indexes
  15.6   Rate limiting             Authentication/API protection
  15.7   Production config         Secure deployment config

## 16. Testing

  ID     Work Package          Deliverable
  ------ --------------------- ---------------------
  16.1   Unit tests            Service/model tests
  16.2   Feature tests         HTTP workflow tests
  16.3   Authorization tests   Role/branch tests
  16.4   Billing tests         Invoice tests
  16.5   Payment tests         Payment tests
  16.6   Scheduler tests       Automated jobs
  16.7   Regression test       Full suite
  16.8   UAT                   User acceptance

## 17. Documentation & Deployment

  ID     Work Package                Deliverable
  ------ --------------------------- ----------------------------
  17.1   README                      Setup documentation
  17.2   Environment documentation   `.env` guide
  17.3   Database documentation      ERD/schema
  17.4   Deployment guide            Production guide
  17.5   Backup guide                MySQL backup/restore
  17.6   Scheduler guide             Cron configuration
  17.7   Queue guide                 Queue worker configuration
  17.8   Release checklist           Production checklist

------------------------------------------------------------------------

# Recommended Implementation Sequence

``` text
Phase 1
Project Setup
      ↓
Phase 2
Authentication + Authorization
      ↓
Phase 3
Branch
      ↓
Phase 4
Teacher + Parent + Student
      ↓
Phase 5
Class
      ↓
Phase 6
Fee Configuration
      ↓
Phase 7
Invoice
      ↓
Phase 8
Payment
      ↓
Phase 9
Outstanding + Reminder
      ↓
Phase 10
Dashboard + Reporting
      ↓
Phase 11
Audit + Security Hardening
      ↓
Phase 12
Testing + UAT
      ↓
Phase 13
Deployment
```

# Suggested Agent Execution Strategy

Do not ask the coding agent to implement the entire application in one
prompt.

Use one work package at a time.

After every work package:

1.  Run migrations.
2.  Run tests.
3.  Inspect generated code.
4.  Verify branch isolation.
5.  Commit changes.
6.  Only then move to the next work package.

This reduces cascading errors and makes the local agent easier to
control.
