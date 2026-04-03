# Marine Command Squad - Production Hosting Guide

## ✅ SECURITY IMPROVEMENTS COMPLETED

Your application has been updated with the following security enhancements:

### 1. **Database Configuration Centralization**
- Created `config.php` - All database connections now use this centralized config
- Supports environment variables for different hosting environments
- Proper error handling (shows generic message in production)

### 2. **SQL Injection Prevention**
- All login processes now use prepared statements
- All registration processes use prepared statements
- Enrollment processes updated with prepared statements
- Direct database queries eliminated

### 3. **Input Validation**
- Aadhaar validation (12 digits)
- Mobile validation (10 digits)
- Password strength requirements (minimum 6 characters)
- Password confirmation matching
- XSS protection with `htmlspecialchars()`

### 4. **Error Handling**
- Development mode shows detailed errors
- Production mode shows generic errors (no database info exposed)
- Proper use of `exit()` after redirects

### 5. **Session Security**
- Created `logout.php` for proper session destruction
- All protected pages check session variables

---

## 🚀 DEPLOYMENT STEPS

### Step 1: Prepare Your Hosting Server

```bash
# SSH into your hosting server
ssh user@yourhost.com

# Navigate to your web root
cd /var/www/html

# Git clone your repository
git clone https://github.com/YOUR-USERNAME/YOUR-REPO.git mcs
cd mcs
```

### Step 2: Set Environment Variables

Create or edit your `.env` file with your hosting credentials:

```bash
# Copy the example
cp .env.example .env

# Edit with your values
nano .env
```

Contents of `.env`:
```
DB_HOST=your_hosting_database_host
DB_USER=your_hosting_database_user
DB_PASS=your_hosting_database_password
DB_NAME=your_hosting_database_name
ENVIRONMENT=production
```

### Step 3: Create the Database

```bash
# Connect to MySQL
mysql -h DB_HOST -u DB_USER -p

# Inside MySQL CLI:
CREATE DATABASE your_database_name;
EXIT;

# Import the schema
mysql -h DB_HOST -u DB_USER -p your_database_name < mcs.sql
```

### Step 4: Set File Permissions

```bash
# Set proper permissions for web server
chmod 755 .
chmod 644 *.php *.html *.css *.js
chmod 755 uploads/
chmod 755 fpdf/

# Ensure web server can write to uploads
chown www-data:www-data uploads/
chmod 775 uploads/
```

### Step 5: Configure Your Web Server

**For Apache (.htaccess):**
Create a `.htaccess` file in your root directory:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /

    # Prevent direct access to config files
    <FilesMatch "^(config\.php|\.env)$">
        Deny from all
    </FilesMatch>

    # Security headers
    <IfModule mod_headers.c>
        Header always set X-Content-Type-Options "nosniff"
        Header always set X-Frame-Options "DENY"
        Header always set X-XSS-Protection "1; mode=block"
    </IfModule>
</IfModule>
```

**For Nginx:**
Add to your server block:

```nginx
# Prevent access to config files
location ~ (config\.php|\.env)$ {
    deny all;
}

# Security headers
add_header X-Content-Type-Options "nosniff" always;
add_header X-Frame-Options "DENY" always;
add_header X-XSS-Protection "1; mode=block" always;
```

### Step 6: Test Your Installation

1. Visit `https://yourdomain.com/index.php`
2. Test cadet login
3. Test officer login
4. Test registration
5. Test logout

### Step 7: Enable HTTPS

```bash
# Using Let's Encrypt (free SSL)
sudo certbot certonly -a webroot -w /var/www/html/mcs -d yourdomain.com
```

---

## 📋 REQUIRED MYSQL TABLES

Make sure your `mcs.sql` file includes these tables:

- `student_register` - Cadet registration data
- `officer_register` - Officer registration data
- `cadet_enrollment` - Cadet enrollment details
- `officer_enrollment` - Officer enrollment details
- `cadet_login` - Cadet login records (if needed)

Run: `mysql -u DB_USER -p DB_NAME < mcs.sql`

---

## 🔒 SECURITY CHECKLIST

Before going live:

- [ ] `.env` file created with production credentials
- [ ] `.env` file is NOT committed to git (check .gitignore)
- [ ] Database credentials changed from default `root` user
- [ ] `ENVIRONMENT=production` set in `.env`
- [ ] HTTPS enabled (SSL certificate installed)
- [ ] `config.php` and `.env` are inaccessible via web server
- [ ] Uploads directory has proper permissions
- [ ] Database backups scheduled
- [ ] Error logs stored outside web root
- [ ] All PHP files updated to use `config.php`

---

## 📂 FILE STRUCTURE

```
your-domain.com/
├── index.php              (Main entry point)
├── config.php             (Database config)
├── .env                   (Environment variables - NOT in git)
├── .env.example           (Template - included in git)
├── .gitignore             (Protects sensitive files)
│
├── Cadet Pages:
├── cadet_login.html
├── cadet_login_process.php
├── cadet_dashboard.php
├── cadet_enrollment.php
├── cadet_enrollment_process.php
│
├── Officer Pages:
├── officer_login.html
├── officer_login_process.php
├── officer_register.html
├── officer_register_process.php
├── officer_dashboard.php
├── officer_enrollment.php
├── officer_enrollment_process.php
│
├── Student Registration:
├── student_register.html
├── student_register_process.php
│
├── Other Pages:
├── home.html
├── about.html
├── contact.html
├── logout.php
│
├── Assets:
├── *.css files
├── *.jpg/*.jpeg files
├── fpdf/ (PDF library)
├── uploads/ (User uploaded files)
│
├── Database:
└── mcs.sql (Database schema)
```

---

## 🆘 TROUBLESHOOTING

### "Database Connection Failed"
- Check `.env` file credentials
- Verify database server is running
- Test connection manually: `mysql -h HOST -u USER -p`

### "Incorrect Password" on login
- Verify user exists in database
- Check password hashing (uses PASSWORD_DEFAULT)
- Ensure form names match: `mobnumber`, `password`

### "File Upload Failed"
- Check `uploads/` directory permissions (should be 775)
- Check file size limits in `php.ini`
- Verify temp directory has space

### "Session Timeout"
- Adjust `session.gc_maxlifetime` in `php.ini`
- Typical production setting: 3600 seconds (1 hour)

### 500 Internal Server Error
- Check error logs: `/var/log/apache2/error.log` or configured log file
- Ensure all required PHP extensions are installed
- Verify file permissions

---

## 📞 CONTACT & SUPPORT

**Marine Command Squad**
- Email: marinecommandsquadofficial@gmail.com
- Phone: +91 9477511624 / +91 6290985896
- Address: 10A, Pandittya Road, Gariahat, Kolkata, 700029

---

## PRODUCTION READY ✅

Your application now has:
✅ SQL Injection Prevention
✅ Input Validation
✅ Secure Database Config
✅ Session Management
✅ Error Handling
✅ Security Headers
✅ Proper Logout Mechanism
✅ Git Protection (.gitignore)

**Status: Ready for Production Hosting**
