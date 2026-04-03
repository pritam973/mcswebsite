# Marine Command Squad - Hosting Readiness Checklist

## ✅ COMPLETED

- [x] Created main entry point (index.php)
- [x] Created database config file (config.php)
- [x] Created missing contact.html page
- [x] Created .gitignore for GitHub

---

## 🔴 CRITICAL - MUST FIX BEFORE HOSTING

### 1. **Update All PHP Files to Use Config File**
   - [ ] Replace database connection code in all files
   - [ ] Current: `$conn = mysqli_connect("localhost","root","","mcs1");`
   - [ ] Change to: `require_once 'config.php';`
   - **Files to update:**
     - cadet_login_process.php
     - officer_login_process.php
     - student_register_process.php
     - officer_register_process.php
     - cadet_enrollment_process.php
     - officer_enrollment_process.php
     - cadet_dashboard.php
     - officer_dashboard.php

### 2. **Fix SQL Injection Vulnerabilities**
   - [ ] Replace all direct $_POST queries with prepared statements
   - **Example Fix:**
     ```php
     // BEFORE (Unsafe)
     $sql = "SELECT * FROM student_register WHERE mobile='$mobile'";
     
     // AFTER (Safe - Prepared Statement)
     $stmt = $conn->prepare("SELECT * FROM student_register WHERE mobile = ?");
     $stmt->bind_param("s", $mobile);
     $stmt->execute();
     $result = $stmt->get_result();
     ```

### 3. **Add Input Validation**
   - [ ] Validate email format
   - [ ] Validate phone numbers
   - [ ] Sanitize all user inputs
   - [ ] Add minimum password strength requirements

### 4. **Configure for Production**
   - [ ] On hosting server, set environment variable: `ENVIRONMENT=production`
   - [ ] Set correct DB credentials in environment
   - [ ] Disable SQL error display in production

---

## 🟡 IMPORTANT - SHOULD FIX

- [ ] Add CSRF token protection to forms
- [ ] Implement rate limiting on login/registration
- [ ] Add password strength validation
- [ ] Create error logging system
- [ ] Add session timeout
- [ ] Fill out contact form handler

---

## 📋 SETUP INSTRUCTIONS FOR HOSTING

### 1. **On Your Hosting Server:**
   ```bash
   # Create environment variables
   export DB_HOST=your_database_host
   export DB_USER=your_database_user
   export DB_PASS=your_database_password
   export DB_NAME=your_database_name
   export ENVIRONMENT=production
   ```

### 2. **Upload All Files to Server**
   ```bash
   git clone [your-github-repo]
   ```

### 3. **Import Database**
   ```bash
   mysql -u DB_USER -p DB_NAME < mcs.sql
   ```

### 4. **Set File Permissions**
   ```bash
   chmod 755 uploads/
   chmod 644 *.php *.html *.css *.js
   ```

### 5. **Test All Pages**
   - Test responsive design
   - Test login/registration
   - Test file uploads
   - Test database connectivity

---

## 📝 Current Status

**Overall Status: 40% Ready for Production**

- Database connection: ⚠️ Needs hardening
- Security: 🔴 Multiple vulnerabilities
- Code quality: ✅ Mostly good (except SQL)
- Frontend: ✅ Complete
- Backend: ⚠️ Needs security updates

---

## 🚀 Priority Order for Fixes

1. **High:** Fix SQL injection (cadet_login_process.php, student_register_process.php, etc.)
2. **High:** Move database credentials to config.php in all files
3. **Medium:** Add input validation
4. **Medium:** Implement CSRF protection
5. **Low:** Add advanced security headers

---

## Questions?
For help implementing fixes, ask about specific files that need security updates.
