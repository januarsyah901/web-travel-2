Berikut adalah seeder untuk database web travel umroh, tidak termasuk tabel bawaan Laravel:

## 1. Seeder untuk Users

```php
<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Ahmad Rizki',
                'birthDate' => '1990-05-15',
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'phone' => '081234567890',
                'hasPassport' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Siti Fatimah',
                'birthDate' => '1985-08-22',
                'address' => 'Jl. Sudirman No. 45, Bandung',
                'phone' => '081298765432',
                'hasPassport' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Budi Santoso',
                'birthDate' => '1978-12-10',
                'address' => 'Jl. Gatot Subroto No. 78, Surabaya',
                'phone' => '081345678901',
                'hasPassport' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Maya Sari',
                'birthDate' => '1992-03-30',
                'address' => 'Jl. Thamrin No. 56, Medan',
                'phone' => '081456789012',
                'hasPassport' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Rudi Hermawan',
                'birthDate' => '1988-07-18',
                'address' => 'Jl. Pahlawan No. 89, Yogyakarta',
                'phone' => '081567890123',
                'hasPassport' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('users')->insert($users);
    }
}
```

## 2. Seeder untuk Packages

```php
<?php
// database/seeders/PackageSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'title' => 'Paket Umroh Reguler 9 Hari',
                'schedule' => '2024-03-15 s/d 2024-03-24',
                'duration' => 9,
                'price' => 35000000.00,
                'description' => 'Paket umroh reguler dengan fasilitas hotel bintang 3, makan 3x sehari, dan transportasi nyaman.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh Plus Turki 12 Hari',
                'schedule' => '2024-04-10 s/d 2024-04-22',
                'duration' => 12,
                'price' => 45000000.00,
                'description' => 'Paket umroh plus tour ke Turki dengan mengunjungi masjid bersejarah dan tempat wisata terkenal.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh VIP 7 Hari',
                'schedule' => '2024-05-05 s/d 2024-05-12',
                'duration' => 7,
                'price' => 55000000.00,
                'description' => 'Paket umroh VIP dengan hotel bintang 5 dekat Masjidil Haram, makan prasmanan, dan guide berpengalaman.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh Ramadhan 14 Hari',
                'schedule' => '2024-04-01 s/d 2024-04-15',
                'duration' => 14,
                'price' => 48000000.00,
                'description' => 'Paket khusus umroh di bulan Ramadhan dengan program ibadah khusus dan buka puasa bersama.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh Ekonomis 10 Hari',
                'schedule' => '2024-06-20 s/d 2024-06-30',
                'duration' => 10,
                'price' => 28000000.00,
                'description' => 'Paket umroh ekonomis dengan harga terjangkau namun tetap nyaman dan berkualitas.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('packages')->insert($packages);
    }
}
```

## 3. Seeder untuk Mutawwifs

```php
<?php
// database/seeders/MutawwifSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MutawwifSeeder extends Seeder
{
    public function run()
    {
        $mutawwifs = [
            [
                'name' => 'Ustadz Abdul Rahman',
                'description' => 'Pengalaman 10 tahun sebagai pembimbing umroh, menguasai bahasa Arab dan Inggris.',
                'photo_path' => 'mutawwifs/ustadz-abdul.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadzah Fatimah Az Zahra',
                'description' => 'Spesialis pembimbing jamaah wanita, alumni Universitas Madinah.',
                'photo_path' => 'mutawwifs/ustadzah-fatimah.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadz Ahmad Al Habsyi',
                'description' => 'Berkeliling dunia untuk dakwah, pengalaman 15 tahun memandu umroh dan haji.',
                'photo_path' => 'mutawwifs/ustadz-ahmad.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('mutawwifs')->insert($mutawwifs);
    }
}
```

## 4. Seeder untuk Partners

```php
<?php
// database/seeders/PartnerSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $partners = [
            [
                'name' => 'Saudi Airlines',
                'logo_path' => 'partners/saudi-airlines.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hotel Al Marwa',
                'logo_path' => 'partners/hotel-al-marwa.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'BIMTRAVEL',
                'logo_path' => 'partners/bimtravel.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kemenag RI',
                'logo_path' => 'partners/kemenag.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('partners')->insert($partners);
    }
}
```

## 5. Seeder untuk Galleries

```php
<?php
// database/seeders/GallerySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $galleries = [
            [
                'title' => 'Ka\'bah di Malam Hari',
                'description' => 'Pemandangan indah Ka\'bah yang diterangi lampu di malam hari',
                'image_path' => 'galleries/kabah-malam.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Masjid Nabawi',
                'description' => 'Keindahan arsitektur Masjid Nabawi di Madinah',
                'image_path' => 'galleries/masjid-nabawi.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Jamaah Tawaf',
                'description' => 'Suasana jamaah yang sedang melaksanakan tawaf',
                'image_path' => 'galleries/jamaah-tawaf.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Jabal Rahmah',
                'description' => 'Bukit Rahmah tempat bersejarah di Arafah',
                'image_path' => 'galleries/jabal-rahmah.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('galleries')->insert($galleries);
    }
}
```

## 6. Seeder untuk Bookings

```php
<?php
// database/seeders/BookingSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $bookings = [
            [
                'user_id' => 1,
                'package_id' => 1,
                'status' => 'confirmed',
                'registered_at' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 2,
                'package_id' => 2,
                'status' => 'pending',
                'registered_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 3,
                'package_id' => 3,
                'status' => 'confirmed',
                'registered_at' => Carbon::now()->subDays(3),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 4,
                'package_id' => 4,
                'status' => 'cancelled',
                'registered_at' => Carbon::now()->subDays(20),
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(18),
            ]
        ];

        DB::table('bookings')->insert($bookings);
    }
}
```

## 7. Seeder untuk Testimonials

```php
<?php
// database/seeders/TestimonialSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'user_id' => 1,
                'content' => 'Alhamdulillah, perjalanan umroh sangat nyaman dan berkah. Pelayanan dari travel sangat memuaskan, guide yang ramah dan berpengalaman.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'user_id' => 3,
                'content' => 'Paket VIP benar-benar worth it! Hotel dekat masjid, makanan enak, dan bimbingan ibadah yang sangat membantu.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'user_id' => 5,
                'content' => 'Pengalaman pertama umroh yang tak terlupakan. Semua terorganisir dengan baik, dari keberangkatan sampai kepulangan.',
                'rating' => 4,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ]
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}
```

## 8. Seeder untuk Passports & Documents

```php
<?php
// database/seeders/PassportSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PassportSeeder extends Seeder
{
    public function run()
    {
        // Passports untuk user yang memiliki passport
        $passports = [
            [
                'user_id' => 1,
                'passportName' => 'Ahmad Rizki',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'passportName' => 'Budi Santoso',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 5,
                'passportName' => 'Rudi Hermawan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('passports')->insert($passports);

        // Documents untuk semua user
        $documents = [
            // User 1
            [
                'user_id' => 1,
                'type' => 'ktp',
                'file_path' => 'documents/user1/ktp.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'type' => 'kk',
                'file_path' => 'documents/user1/kk.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // User 2
            [
                'user_id' => 2,
                'type' => 'ktp',
                'file_path' => 'documents/user2/ktp.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'type' => 'birthCert',
                'file_path' => 'documents/user2/birth-cert.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // User 3
            [
                'user_id' => 3,
                'type' => 'ktp',
                'file_path' => 'documents/user3/ktp.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'type' => 'photo',
                'file_path' => 'documents/user3/photo.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('documents')->insert($documents);

        // Passport photos
        $passportPhotos = [
            [
                'passport_id' => 1,
                'file_path' => 'passport-photos/passport1-photo1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'passport_id' => 2,
                'file_path' => 'passport-photos/passport2-photo1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'passport_id' => 3,
                'file_path' => 'passport-photos/passport3-photo1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('passport_photos')->insert($passportPhotos);
    }
}
```

## 9. Database Seeder Utama

```php
<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PackageSeeder::class,
            MutawwifSeeder::class,
            PartnerSeeder::class,
            GallerySeeder::class,
            PassportSeeder::class, // Ini sudah include documents dan passport_photos
            BookingSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
```
