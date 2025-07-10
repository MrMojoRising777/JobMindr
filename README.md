# JobMindr – Job Application Tracker

**JobMindr** is a simple Laravel-based job-tracking system to help users manage job applications from one central dashboard.

---

## ✨ Features

- 🔐 Login system
- 🏢 Add companies with auto-filled Dutch address info via [PDOK.nl](https://www.pdok.nl/) (postcode + house number)
- 👥 Link contact persons to companies
- 📄 Track applications with properties:
  - Salary range
  - Education/experience level
  - Work location
  - Status updates (e.g. Rejected + reason)
- 📊 Dashboard with Chart.js showing weekly/monthly stats

---

## ⚙️ Tech Stack

- Laravel 10
- MySQL
- Blade, Chart.js
- PDOK API for address lookup

---

## 🚀 Setup

```bash
git clone https://github.com/MrMojoRising777/JobMindr.git
cd JobMindr
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
npm install && npm run dev
php artisan serve
