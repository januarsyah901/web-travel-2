# Panduan Deploy Laravel Project ke Hostinger

## Informasi Project
- **Framework**: Laravel 12
- **Frontend**: Vue.js dengan Vite
- **Database**: MySQL (recommended untuk production)
- **PHP Version**: 8.2+
- **Node Version**: 16+ (untuk build)

---

## TAHAP 1: Persiapan di Hostinger

### 1.1 Login ke Hostinger Control Panel
- Buka https://hpanel.hostinger.com
- Login dengan akun Hostinger kamu

### 1.2 Setup Domain & SSL
- Pastikan domain sudah pointing ke Hostinger
- Aktifkan SSL/TLS Certificate (gratis via Let's Encrypt)
- Tunggu propagasi DNS (bisa 24 jam)

### 1.3 Buat Database MySQL
Di **Databases** menu:
1. Klik "Create Database"
2. Nama database: `laravel_travel` (sesuaikan)
3. Username: `travel_user`
4. Password: `[Generate strong password]`
5. Catat credentials ini untuk `.env` nanti

### 1.4 Akses SSH/Terminal
Di **Advanced** → **SSH Access**:
1. Pastikan SSH enabled
2. Download SSH key atau gunakan password auth
3. Catat SSH credentials:
   - Host: `[server-ip-atau-domain]`
   - Username: `root` atau `hpanel-user`
   - Port: `22`

---

## TAHAP 2: Upload Project ke Server

Ada 3 cara upload:

### Opsi A: Menggunakan Git (RECOMMENDED)
```bash
# Connect via SSH
ssh -p 22 [username]@[host]

# Navigate ke public_html
cd public_html

# Clone project
git clone [your-github-repo-url] ./
# atau jika ingin di subdirectory:
git clone [your-github-repo-url] travel

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### Opsi B: Menggunakan FTP/SFTP
1. Gunakan FileZilla atau aplikasi FTP lainnya
2. Upload semua file ke `public_html/`
3. SSH ke server dan jalankan:
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### Opsi C: Menggunakan cPanel File Manager
1. Upload file compressed (.zip)
2. Extract via File Manager
3. SSH untuk install dependencies

---

## TAHAP 3: Setup Environment & Konfigurasi

### 3.1 Buat & Edit .env file
```bash
# Copy dari .env.example
cp .env.example .env

# Edit dengan nano/vi
nano .env
```

### 3.2 Konfigurasi .env untuk Production
```env
APP_NAME="Web Travel"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database Configuration (MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_travel
DB_USERNAME=travel_user
DB_PASSWORD=your_strong_password

# Session & Cache - gunakan database di production
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (Optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=noreply@yourdomain.com

# App Key
APP_KEY=  # Will be generated in next step

# Filesystem
FILESYSTEM_DISK=local

# Broadcast
BROADCAST_CONNECTION=database
```

### 3.3 Generate Application Key
```bash
php artisan key:generate
```

### 3.4 Setup Storage & Permissions
```bash
# Buat symbolic link untuk storage
php artisan storage:link

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chmod -R 755 public

# If needed, set ownership
# chown -R www-data:www-data /path/to/project
```

---

## TAHAP 4: Database Migration & Seeding

```bash
# Run migrations
php artisan migrate --force

# If you have seeders
php artisan db:seed --force

# Check database
php artisan tinker
# Di tinker: User::count() atau model lainnya
```

---

## TAHAP 5: Setup Web Server

### 5.1 Configure Public Root (PENTING!)
Di Hostinger cPanel/hPanel:
1. Go to **Domains** → Your Domain
2. Set **Document Root** ke: `/public_html/public`
   - Atau jika di subdirectory: `/public_html/travel/public`
3. Ensure `.htaccess` is enabled

### 5.2 Check .htaccess
File `public/.htaccess` harus ada dan berisi:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [QSA,L]
</IfModule>
```

### 5.3 Enable Required Modules
SSH to server:
```bash
# Check Apache modules
a2enmod rewrite
a2enmod headers
a2enmod ssl

# Restart Apache
systemctl restart apache2
# or
sudo /etc/init.d/apache2 restart
```

---

## TAHAP 6: Optimization & Final Checks

### 6.1 Clear & Cache Configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 6.2 Install Composer Auto-loader
```bash
composer install --optimize-autoloader --no-dev
```

### 6.3 Test Endpoints
```bash
# Test main URL
curl -I https://yourdomain.com

# Test API endpoints
curl https://yourdomain.com/api/test
```

---

## TAHAP 7: SSL Certificate

### 7.1 Force HTTPS (Add to .htaccess)
```apache
RewriteEngine On
RewriteCond %{HTTPS} !on
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 7.2 Verify SSL in Laravel
Di `config/app.php` atau `.env`:
```php
'url' => env('APP_URL', 'https://yourdomain.com'),
```

---

## TAHAP 8: Setup Cron Jobs (Jika Ada)

Di Hostinger hPanel → **Cron Jobs**:

### Untuk Laravel Queue & Scheduler:
```bash
# Add cron job:
* * * * * /usr/bin/php /home/[username]/public_html/artisan schedule:run >> /dev/null 2>&1

# Untuk queue (jika menggunakan):
* * * * * /usr/bin/php /home/[username]/public_html/artisan queue:work --max-tries=3
```

---

## TAHAP 9: Monitoring & Maintenance

### 9.1 View Logs
```bash
tail -f storage/logs/laravel.log
```

### 9.2 Check Application Health
```bash
php artisan route:list
php artisan config:show
php artisan about
```

### 9.3 Regular Backups
- Enable automatic backups di Hostinger hPanel
- Or manually backup database:
```bash
mysqldump -u travel_user -p laravel_travel > backup.sql
```

---

## Troubleshooting

### Error 500 - Internal Server Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Check permissions
ls -la storage/
ls -la bootstrap/cache/

# Verify .env
cat .env
```

### 404 on Routes
- Check if `.htaccess` exists in `/public`
- Check if `mod_rewrite` is enabled
- Verify Document Root points to `/public`

### Database Connection Error
- Check `.env` database credentials
- Verify database exists: `mysql -u root -p -e "SHOW DATABASES;"`
- Check user permissions: `mysql -u root -p -e "SHOW GRANTS FOR 'travel_user'@'localhost';"`

### Vite Assets Not Loading
- Verify `npm run build` was executed
- Check if `public/build/` directory exists
- Verify paths in `resources/views/app.blade.php`

### Storage Link Not Working
```bash
rm public/storage
php artisan storage:link

# Or if still fails, create symbolic link manually:
ln -s storage/app/public public/storage
```

---

## Useful Commands Reference

```bash
# SSH Connection
ssh -p 22 username@hostname

# Install & Build
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Database
php artisan migrate --force
php artisan db:seed --force
php artisan tinker

# Cache & Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Monitoring
php artisan about
php artisan route:list
tail -f storage/logs/laravel.log

# Maintenance
php artisan down
php artisan up
php artisan storage:link
```

---

## Checklist Sebelum Go Live

- [x] Domain configured & pointing ke Hostinger
- [x] SSL certificate installed & active
- [x] MySQL database created dengan user
- [x] Project uploaded via Git/FTP
- [x] Composer & NPM dependencies installed
- [x] .env configured dengan production values
- [x] APP_KEY generated
- [x] Database migrations run
- [x] Document Root set ke `/public`
- [x] .htaccess enabled & mod_rewrite active
- [x] Storage directory writable & linked
- [x] Assets compiled & cache cleared
- [x] Logs accessible & readable
- [x] Cron jobs configured (if needed)
- [x] Test all main routes & API endpoints
- [x] Backup strategy in place

---

## Contact & Support

Jika ada error atau pertanyaan:
1. Cek `storage/logs/laravel.log`
2. Baca error message dengan teliti
3. Restart Apache: `systemctl restart apache2`
4. Contact Hostinger support dengan info lengkap

---

**Last Updated**: March 2026
**Status**: Production Ready
