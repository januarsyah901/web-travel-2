<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('admin.sidebar')
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white shadow-sm z-10">
            <div class="flex items-center justify-between p-4">
                <button onclick="toggleSidebar()" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Hello, {{ Auth::guard('admin')->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Dashboard Section -->
            <div id="dashboard" class="content-section {{ $section ? 'hidden' : '' }}">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Pendaftar Umroh</p>
                                <p class="text-3xl font-bold text-indigo-600">{{ $counts['users'] }}</p>
                            </div>
                            <div class="bg-indigo-100 p-4 rounded-full">
                                <i class="fas fa-users text-indigo-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Total Bookings</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $counts['bookings'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-calendar-check text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Packages</p>
                                <p class="text-3xl font-bold text-green-600">{{ $counts['packages'] }}</p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-full">
                                <i class="fas fa-box text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Partners</p>
                                <p class="text-3xl font-bold text-purple-600">{{ $counts['partners'] }}</p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-full">
                                <i class="fas fa-handshake text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Section (Pendaftar Umroh) -->
            <div id="users" class="content-section {{ $section == 'users' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Pendaftar Umroh</h2>
                    <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Pendaftar
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Lahir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paspor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->birthDate ? $user->birthDate->format('d/m/Y') : 'N/A' }}</td>
                            <td class="px-6 py-4">{{ Str::limit($user->address, 30) }}</td>
                            <td class="px-6 py-4">{{ $user->phone }}</td>
                            <td class="px-6 py-4">
                                @if($user->hasPassport)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                        <i class="fas fa-check"></i> Ada
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">
                                        <i class="fas fa-times"></i> Belum
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('users.show', $user->id) }}" class="text-green-600 hover:text-green-800 mr-3" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 mr-3" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus pendaftar ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data pendaftar umroh</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Galeri Section -->
            <div id="galeri" class="content-section {{ $section == 'galleries' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Galeri</h2>
                    <a href="{{ route('galleries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Foto
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($galleries as $gallery)
                        <tr>
                            <td class="px-6 py-4">{{ $gallery->id }}</td>
                            <td class="px-6 py-4">{{ $gallery->title }}</td>
                            <td class="px-6 py-4">{{ Str::limit($gallery->description, 50) }}</td>
                            <td class="px-6 py-4">
                                @if($gallery->image_path)
                                    <a href="{{ asset('storage/' . $gallery->image_path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('galleries.edit', $gallery->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('galleries.destroy', $gallery->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data galeri</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mutawifs Section -->
            <div id="mutawifs" class="content-section {{ $section == 'mutawwifs' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Mutawifs</h2>
                    <a href="{{ route('mutawwifs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Mutawif
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($mutawwifs as $mutawwif)
                        <tr>
                            <td class="px-6 py-4">{{ $mutawwif->id }}</td>
                            <td class="px-6 py-4">{{ $mutawwif->name }}</td>
                            <td class="px-6 py-4">{{ Str::limit($mutawwif->description, 50) }}</td>
                            <td class="px-6 py-4">
                                @if($mutawwif->photo_path)
                                    <a href="{{ asset('storage/' . $mutawwif->photo_path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('mutawwifs.edit', $mutawwif->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('mutawwifs.destroy', $mutawwif->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data mutawif</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Partner Section -->
            <div id="partner" class="content-section {{ $section == 'partners' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Partner</h2>
                    <a href="{{ route('partners.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Partner
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($partners as $partner)
                        <tr>
                            <td class="px-6 py-4">{{ $partner->id }}</td>
                            <td class="px-6 py-4">{{ $partner->name }}</td>
                            <td class="px-6 py-4">
                                @if($partner->logo_path)
                                    <a href="{{ asset('storage/' . $partner->logo_path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('partners.edit', $partner->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('partners.destroy', $partner->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data partner</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Testimoni Section -->
            <div id="testimoni" class="content-section {{ $section == 'testimonials' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Testimoni</h2>
                    <a href="{{ route('testimonials.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Testimoni
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Komentar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($testimonials as $testimonial)
                        <tr>
                            <td class="px-6 py-4">{{ $testimonial->id }}</td>
                            <td class="px-6 py-4">{{ $testimonial->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ Str::limit($testimonial->content, 50) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('testimonials.destroy', $testimonial->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data testimoni</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bookings Section -->
            <div id="bookings" class="content-section {{ $section == 'bookings' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Bookings</h2>
                    <a href="{{ route('bookings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Booking
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4">{{ $booking->id }}</td>
                            <td class="px-6 py-4">{{ $booking->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $booking->package->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $booking->registered_at ? $booking->registered_at->format('Y-m-d') : 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">{{ $booking->status }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data booking</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Packages Section -->
            <div id="packages" class="content-section {{ $section == 'packages' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Packages</h2>
                    <a href="{{ route('packages.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Paket
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Paket</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($packages as $package)
                        <tr>
                            <td class="px-6 py-4">{{ $package->id }}</td>
                            <td class="px-6 py-4">{{ $package->title }}</td>
                            <td class="px-6 py-4">{{ $package->duration }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('packages.edit', $package->id) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('packages.destroy', $package->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data paket</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(section => section.classList.add('hidden'));
        document.getElementById(sectionId).classList.remove('hidden');

        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => link.classList.remove('bg-blue-700'));
        event.target.closest('.nav-link').classList.add('bg-blue-700');
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }

    // Set dashboard as active by default
    document.addEventListener('DOMContentLoaded', function() {
        const firstLink = document.querySelector('.nav-link');
        if (firstLink) {
            firstLink.classList.add('bg-blue-700');
        }
    });
</script>
</body>
</html>
