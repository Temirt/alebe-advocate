# Alebe Advocate - Legal Services Platform

Professional legal services platform for Ethiopian law, including an automated legal forms store and live attorney consultation.

## 🚀 Features
- **Legal Form Store**: 17+ professional templates for contracts, applications, and agreements.
- **Search System**: Premium search bar for practice areas and documents.
- **Support**: Integrated WhatsApp, TikTok, and YouTube channels.
- **Admin Panel**: Complete management of orders, forms, and client messages.

## 🛠️ Deployment Instructions
1. Clone the repository.
2. Run `composer install` and `npm install`.
3. Build assets: `npm run build`.
4. Configure `.env` with production values.
5. Migrate and Seed: `php artisan migrate --seed`.
6. Link Storage: `php artisan storage:link`.

## 📦 Tech Stack
- **Backend**: Laravel 12.x
- **Frontend**: TailwindCSS, Alpine.js
- **Database**: SQLite (local) / MySQL (prod)
- **Deployment**: GitHub and cPanel support.

---
© 2026 Alebe Advocate. All Rights Reserved.
