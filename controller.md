

# ✅ **1. UserController (Monolith)**

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'fullName' => 'required',
            'birthDate' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'hasPassport' => 'boolean',
        ]);

        return User::create($data);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id) {
        return User::destroy($id);
    }
}
```

---

# ✅ **2. PackageController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index() {
        return Package::all();
    }

    public function show($id) {
        return Package::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'schedule' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ]);

        return Package::create($data);
    }

    public function update(Request $request, $id) {
        $pkg = Package::findOrFail($id);
        $pkg->update($request->all());
        return $pkg;
    }

    public function destroy($id) {
        return Package::destroy($id);
    }
}
```

---

# ✅ **3. BookingController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        return Booking::with(['user', 'package'])->get();
    }

    public function show($id) {
        return Booking::with(['user', 'package'])->findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'package_id' => 'required',
            'status' => 'nullable',
        ]);

        return Booking::create($data);
    }

    public function update(Request $request, $id) {
        $book = Booking::findOrFail($id);
        $book->update($request->all());
        return $book;
    }

    public function destroy($id) {
        return Booking::destroy($id);
    }
}
```

---

# ✅ **4. DocumentController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index() {
        return Document::all();
    }

    public function show($id) {
        return Document::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'type' => 'required',
            'file_path' => 'required',
        ]);

        return Document::create($data);
    }

    public function update(Request $request, $id) {
        $doc = Document::findOrFail($id);
        $doc->update($request->all());
        return $doc;
    }

    public function destroy($id) {
        return Document::destroy($id);
    }
}
```

---

# ✅ **5. PassportController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function index() {
        return Passport::with('photos')->get();
    }

    public function show($id) {
        return Passport::with('photos')->findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'passportName' => 'nullable',
        ]);

        return Passport::create($data);
    }

    public function update(Request $request, $id) {
        $passport = Passport::findOrFail($id);
        $passport->update($request->all());
        return $passport;
    }

    public function destroy($id) {
        return Passport::destroy($id);
    }
}
```

---

# ✅ **6. PassportPhotoController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\PassportPhoto;
use Illuminate\Http\Request;

class PassportPhotoController extends Controller
{
    public function index() {
        return PassportPhoto::all();
    }

    public function show($id) {
        return PassportPhoto::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'passport_id' => 'required',
            'file_path' => 'required',
        ]);

        return PassportPhoto::create($data);
    }

    public function update(Request $request, $id) {
        $photo = PassportPhoto::findOrFail($id);
        $photo->update($request->all());
        return $photo;
    }

    public function destroy($id) {
        return PassportPhoto::destroy($id);
    }
}
```

---

# ✅ **7. TestimonialController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() {
        return Testimonial::with('user')->get();
    }

    public function show($id) {
        return Testimonial::with('user')->findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
            'package_id' => 'nullable',
            'message' => 'required',
            'rating' => 'nullable|integer',
        ]);

        return Testimonial::create($data);
    }

    public function update(Request $request, $id) {
        $t = Testimonial::findOrFail($id);
        $t->update($request->all());
        return $t;
    }

    public function destroy($id) {
        return Testimonial::destroy($id);
    }
}
```

---

# ✅ **8. PartnerController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index() {
        return Partner::all();
    }

    public function show($id) {
        return Partner::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'logo_file' => 'nullable'
        ]);

        return Partner::create($data);
    }

    public function update(Request $request, $id) {
        $p = Partner::findOrFail($id);
        $p->update($request->all());
        return $p;
    }

    public function destroy($id) {
        return Partner::destroy($id);
    }
}
```

---

# ✅ **9. MutawwifController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Mutawwif;
use Illuminate\Http\Request;

class MutawwifController extends Controller
{
    public function index() {
        return Mutawwif::all();
    }

    public function show($id) {
        return Mutawwif::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'bio' => 'nullable',
            'photo_file' => 'nullable',
        ]);

        return Mutawwif::create($data);
    }

    public function update(Request $request, $id) {
        $m = Mutawwif::findOrFail($id);
        $m->update($request->all());
        return $m;
    }

    public function destroy($id) {
        return Mutawwif::destroy($id);
    }
}
```

---

# ✅ **10. GalleryController**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index() {
        return Gallery::all();
    }

    public function show($id) {
        return Gallery::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'file_path' => 'required',
            'category' => 'nullable',
        ]);

        return Gallery::create($data);
    }

    public function update(Request $request, $id) {
        $g = Gallery::findOrFail($id);
        $g->update($request->all());
        return $g;
    }

    public function destroy($id) {
        return Gallery::destroy($id);
    }
}
```

---
