
```bash
php artisan make:model User -m
php artisan make:model Package -m
php artisan make:model Booking -m
php artisan make:model Document -m
php artisan make:model Passport -m
php artisan make:model PassportPhoto -m
php artisan make:model Testimonial -m
php artisan make:model Partner -m
php artisan make:model Mutawwif -m
php artisan make:model Gallery -m
```

---

## 2️⃣ Migration Files

Contoh isi migration-nya (gue kasih inti utamanya, lo bisa copas ke file di `database/migrations/`).

### 🧑 Users

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('fullName');
    $table->date('birthDate');
    $table->text('address');
    $table->string('phone');
    $table->boolean('hasPassport')->default(false);
    $table->timestamps();
});
```

### 📦 Packages

```php
Schema::create('packages', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('schedule'); 
    $table->integer('duration');
    $table->decimal('price', 12, 2);
    $table->text('description')->nullable();
    $table->timestamps();
});
```

### 📑 Bookings

```php
Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('package_id')->constrained()->onDelete('cascade');
    $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
    $table->timestamp('registered_at')->useCurrent();
    $table->timestamps();
});
```

### 📄 Documents

```php
Schema::create('documents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['ktp', 'kk', 'birthCert', 'photo']);
    $table->string('file_path');
    $table->timestamps();
});
```

### 🛂 Passports

```php
Schema::create('passports', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('passportName')->nullable();
    $table->timestamps();
});
```

### 🖼️ Passport Photos

```php
Schema::create('passport_photos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('passport_id')->constrained()->onDelete('cascade');
    $table->string('file_path');
    $table->timestamps();
});
```

### 💬 Testimonials

```php
Schema::create('testimonials', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('package_id')->nullable()->constrained()->onDelete('set null');
    $table->text('message');
    $table->tinyInteger('rating')->default(5);
    $table->timestamps();
});
```

### 🤝 Partners

```php
Schema::create('partners', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('logo_file');
    $table->timestamps();
});
```

### 🕌 Mutawwif

```php
Schema::create('mutawwifs', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('bio')->nullable();
    $table->string('photo_file')->nullable();
    $table->timestamps();
});
```

### 🖼️ Gallery

```php
Schema::create('galleries', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('file_path');
    $table->string('category')->nullable();
    $table->timestamps();
});
```

---

## 3️⃣ Relasi di Model

Contoh `User.php`:

```php
class User extends Authenticatable
{
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function documents() {
        return $this->hasMany(Document::class);
    }

    public function passport() {
        return $this->hasOne(Passport::class);
    }

    public function testimonials() {
        return $this->hasMany(Testimonial::class);
    }
}
```

Contoh `Package.php`:

```php
class Package extends Model
{
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function testimonials() {
        return $this->hasMany(Testimonial::class);
    }
}
```

Contoh `Passport.php`:

```php
class Passport extends Model
{
    public function photos() {
        return $this->hasMany(PassportPhoto::class);
    }
}
```

---

