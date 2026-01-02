# 📁 STRUKTUR VIEWS - ADMIN PANEL

## 🎯 Tujuan Restrukturisasi
Membuat views lebih modular, mudah di-maintain, dan mengikuti best practices Laravel Blade.

---

## 📂 Struktur Direktori

```
views/admin/
├── layouts/
│   ├── app.blade.php              # Master layout utama
│   ├── header.blade.php            # Component header
│   ├── sidebar.blade.php           # Component sidebar navigation
│   └── partials/
│       ├── alerts.blade.php        # Alert messages (success, error, warning)
│       ├── styles.blade.php        # Global CSS styles
│       └── scripts.blade.php       # Global JavaScript
│
├── sections/                       # Content sections untuk dashboard
│   ├── dashboard.blade.php         # Dashboard overview section
│   ├── users.blade.php             # Users management section
│   ├── bookings.blade.php          # Bookings management section
│   ├── packages.blade.php          # Packages management section
│   ├── mutawwifs.blade.php         # Mutawwifs management section
│   ├── partners.blade.php          # Partners management section
│   ├── galleries.blade.php         # Galleries management section
│   └── testimonials.blade.php      # Testimonials management section
│
├── users/                          # User detail pages
│   └── show.blade.php              # User detail view
│
├── bookings/                       # Booking pages (jika ada)
├── packages/                       # Package pages (jika ada)
├── galleries/                      # Gallery pages (jika ada)
├── mutawwifs/                      # Mutawwif pages (jika ada)
├── contact/                        # Contact pages (jika ada)
│
├── dashboard.blade.php             # Main dashboard page (simplified)
├── login.blade.php                 # Login page
└── modal.blade.php                 # Modal components (jika dipakai)
```

---

## 🔧 Cara Penggunaan

### 1. **Master Layout (`layouts/app.blade.php`)**
File ini adalah template utama yang digunakan oleh semua halaman admin.

**Fitur:**
- Include head, scripts, styles
- Sidebar dan header
- Alert messages
- Content area dengan `@yield('content')`

**Contoh Penggunaan:**
```blade
@extends('admin.layouts.app')

@section('title', 'Halaman Saya')
@section('page-title', 'Judul Halaman')

@section('content')
    <!-- Content disini -->
@endsection

@push('styles')
    <!-- Custom styles untuk halaman ini -->
@endpush

@push('scripts')
    <!-- Custom scripts untuk halaman ini -->
@endpush
```

### 2. **Components**

#### Header (`layouts/header.blade.php`)
- Hamburger menu button
- Page title (dynamic via `@yield('page-title')`)
- User info & logout button

#### Sidebar (`layouts/sidebar.blade.php`)
- Navigation menu
- Logo & branding
- Responsive (collapse/expand)
- Active state detection

#### Alerts (`layouts/partials/alerts.blade.php`)
- Success messages
- Error messages
- Warning messages
- Auto-dismiss after 5 seconds

### 3. **Sections**
Folder `sections/` berisi content sections untuk dashboard. Setiap section adalah komponen terpisah yang di-include di dashboard.

**Contoh:**
```blade
@include('admin.sections.users')
@include('admin.sections.bookings')
```

### 4. **Global Styles & Scripts**
- `partials/styles.blade.php`: CSS global (hamburger, overlay, animations)
- `partials/scripts.blade.php`: JavaScript global (sidebar toggle, alerts, device detection)

---

## 📝 Best Practices

### ✅ DO
1. Gunakan `@extends` untuk inherit dari master layout
2. Gunakan `@section` dan `@yield` untuk content areas
3. Gunakan `@include` untuk reusable components
4. Gunakan `@push` dan `@stack` untuk page-specific assets
5. Pisahkan logic dari view (gunakan controller)
6. Beri nama file secara konsisten (plural, lowercase, English)

### ❌ DON'T
1. Jangan duplikasi HTML/CSS/JS di multiple files
2. Jangan hardcode data di view (gunakan data dari controller)
3. Jangan mix inline styles dengan CSS files
4. Jangan buat file dengan nama tidak jelas
5. Jangan taruh business logic di view

---

## 🔄 Migration Guide

### Old Structure → New Structure

| Old | New |
|-----|-----|
| `admin/sidebar/pendaftar.blade.php` | `admin/sections/users.blade.php` |
| `admin/sidebar/galeri.blade.php` | `admin/sections/galleries.blade.php` |
| `admin/sidebar/mutawwif.blade.php` | `admin/sections/mutawwifs.blade.php` |
| `admin/sidebar/package.blade.php` | `admin/sections/packages.blade.php` |
| `admin/sidebar/partner.blade.php` | `admin/sections/partners.blade.php` |
| `admin/sidebar/booking.blade.php` | `admin/sections/bookings.blade.php` |
| `admin/sidebar/testimoni.blade.php` | `admin/sections/testimonials.blade.php` |
| `admin/sidebar.blade.php` | `admin/layouts/sidebar.blade.php` |

### Update Include Statements
Jika ada file lain yang masih menggunakan path lama, update ke:
```blade
<!-- Old -->
@include('admin.sidebar.pendaftar')

<!-- New -->
@include('admin.sections.users')
```

---

## 🚀 Benefits

### 1. **Maintainability** ⭐⭐⭐⭐⭐
- Components terpisah dan reusable
- Mudah cari file yang perlu diedit
- Struktur jelas dan terorganisir

### 2. **Scalability** ⭐⭐⭐⭐⭐
- Mudah tambah halaman baru
- Mudah tambah sections baru
- Template inheritance yang proper

### 3. **Performance** ⭐⭐⭐⭐
- No duplicate code
- Global assets di-load sekali
- Efficient caching

### 4. **Developer Experience** ⭐⭐⭐⭐⭐
- Konsisten naming convention
- Jelas struktur folder
- Dokumentasi lengkap

---

## 📞 Support

Jika ada pertanyaan tentang struktur baru ini, silakan hubungi tim development.

**Last Updated:** January 2, 2026

