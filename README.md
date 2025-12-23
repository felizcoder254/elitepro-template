# 🚀 ElitePro - Professional Learning Platform Template

A complete Laravel template for certification platforms, online courses, and learning management systems.

## ✨ Live Preview
- **Homepage:** https://demo.elitepro.com
- **Dashboard:** https://demo.elitepro.com/dashboard (Login: demo@elitepro.com / password)

## 📱 What's Included

### 4 Ready-to-Use Pages
| Page | Description | Preview |
|------|-------------|---------|
| **🏠 Homepage** | Professional landing page with hero, features, pricing | [View] |
| **🔐 Login** | Modern authentication with glassmorphism design | [View] |
| **📝 Register** | User registration with password strength indicator | [View] |
| **📊 Dashboard** | Professional dashboard with stats and analytics | [View] |

## 🚀 Quick Installation

### Step 1: Install Dependencies
```bash
composer install
npm install
Step 2: Setup Environment
bash
cp .env.example .env
php artisan key:generate
Step 3: Setup Database
bash
# SQLite (Default - Quick Start)
touch database/database.sqlite

# Run migrations to create database tables
php artisan migrate

# OR MySQL (Production)
# 1. Update .env file with MySQL credentials
# 2. php artisan migrate
Step 4: Start Development Server
bash
php artisan serve
npm run dev
Access Your Application
Homepage: http://localhost:8000/

Login: http://localhost:8000/login

Dashboard: http://localhost:8000/dashboard

Demo Credentials:

text
Email: demo@example.com
Password: password
🎨 Quick Customization
1. Change Brand Name
Replace "ElitePro" with your brand name:

bash
# Linux/Mac
find . -name "*.blade.php" -exec sed -i 's/ElitePro/YourBrand/g' {} \;

# Or edit manually in all .blade.php files
2. Update Colors
Edit CSS variables in any .blade.php file:

css
:root {
    --primary: #6366f1;      /* Your brand color */
    --bg-primary: #0f172a;   /* Background color */
    --text-primary: #f8fafc; /* Text color */
}
3. Replace Logo
Save your logo as /public/images/logo.png (180×48px recommended)

4. Update Content
Homepage: Edit home.blade.php

Dashboard: Edit dashboard.blade.php

Auth pages: Edit auth/login.blade.php and auth/register.blade.php

📁 File Structure
text
resources/views/
├── home.blade.php          # Main landing page
├── dashboard.blade.php     # User dashboard
└── auth/
    ├── login.blade.php     # Login page
    ├── register.blade.php  # Registration page
    └── (migrations included for auth tables)

routes/web.php              # Application routes
database/
├── migrations/             # Database migrations
└── database.sqlite         # SQLite database file
public/images/              # Images and logos
🔧 Troubleshooting
Common Issues & Solutions
Issue	Solution
"Migration table not found"	Run php artisan migrate:install first
"Page not found"	Run php artisan route:clear
CSS/JS not loading	Run php artisan view:clear && npm run build
Database errors	Delete database/database.sqlite and run php artisan migrate
Login not working	Check storage/logs/laravel.log
Quick Fix Commands
bash
# Clear all caches
php artisan optimize:clear

# Reset database (SQLite)
rm database/database.sqlite
touch database/database.sqlite
php artisan migrate

# Rebuild assets
npm run build
📞 Support
Documentation: See DOCUMENTATION.md for detailed guide

Issues: Check storage/logs/laravel.log

Questions: support@elitepro.com

🛠 Requirements
PHP 8.1+

Composer 2.0+

Laravel 12+

Node.js 18+

📄 License
Commercial License - See LICENSE.md for details

✨ Credits
Design: Modern SaaS patterns

Icons: Font Awesome 6

Fonts: Google Fonts

Framework: Laravel