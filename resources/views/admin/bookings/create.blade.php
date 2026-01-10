@extends('admin.layouts.app')

@section('title', 'Tambah Booking')

@section('page-title', 'Tambah Booking Baru')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Booking Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Daftarkan booking jamaah dengan teliti.</p>
            </div>
        </div>
        <a href="{{ route('admin.dashboard', ['section' => 'bookings']) }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors shadow-sm flex items-center justify-center w-full md:w-auto">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</p>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('bookings.store') }}" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        @csrf

        <div class="p-6 md:p-8 space-y-8">

            <div class="pb-2 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-1 h-6 bg-blue-500 rounded-full inline-block"></span>
                    Informasi Booking
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="user_id" class="text-sm font-semibold text-gray-700">Pilih Jamaah <span class="text-red-500">*</span></label>
                    <select name="user_id" id="user_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        <option value="">-- Pilih Jamaah --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->fullName }} ({{ $user->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="package_id" class="text-sm font-semibold text-gray-700">Pilih Paket <span class="text-red-500">*</span></label>
                    <select name="package_id" id="package_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->title }} (Rp {{ number_format($package->price, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="status" class="text-sm font-semibold text-gray-700">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed (Lunas)</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="registered_at" class="text-sm font-semibold text-gray-700">Tanggal Daftar <span class="text-red-500">*</span></label>
                    <input type="date" name="registered_at" id="registered_at" value="{{ old('registered_at', date('Y-m-d')) }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                </div>
            </div>

        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
            <a href="{{ route('admin.dashboard', ['section' => 'bookings']) }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-colors text-center shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Simpan Booking
            </button>
        </div>
    </form>

    <div class="mt-6 flex gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl text-blue-800 text-sm">
        <i class="fas fa-info-circle mt-0.5 text-lg"></i>
        <div>
            <p class="font-bold">Catatan:</p>
            <ul class="list-disc list-inside mt-1 space-y-1 text-blue-700">
                <li>Pastikan memilih jamaah dan paket yang sesuai.</li>
                <li>Status booking dapat diubah sesuai progres pembayaran.</li>
                <li>Tanggal daftar akan dicatat sebagai tanggal pendaftaran resmi.</li>
            </ul>
        </div>
    </div>

</div>
@endsection
