<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data - {{ $user->fullName }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-900 min-h-screen">

<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">

    @if(session('success'))
        <div id="success-alert" class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-start animate-fade-in-down">
            <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
            <div>
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r shadow-sm flex items-start">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
            <div>
                <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan input:</h3>
                <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Data Pendaftar</h1>
                <p class="text-gray-500 text-sm mt-1">Perbarui informasi jamaah dengan teliti.</p>
            </div>
        </div>
        <a href="{{ route('users.show', $user->id) }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors shadow-sm flex items-center justify-center w-full md:w-auto">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('users.update', $user->id) }}" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-8">

            <div class="pb-2 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-1 h-6 bg-blue-500 rounded-full inline-block"></span>
                    Informasi Pribadi
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="fullName" class="text-sm font-semibold text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="fullName" id="fullName" value="{{ old('fullName', $user->fullName) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                </div>

                <div class="space-y-2">
                    <label for="birthDate" class="text-sm font-semibold text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="birthDate" id="birthDate" value="{{ old('birthDate', $user->birthDate ? $user->birthDate->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                </div>

                <div class="space-y-2">
                    <label for="phone" class="text-sm font-semibold text-gray-700">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400"><i class="fab fa-whatsapp"></i></span>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold text-gray-700">Email (Opsional)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400"><i class="far fa-envelope"></i></span>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="contoh@email.com"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none">
                    </div>
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label for="address" class="text-sm font-semibold text-gray-700">Alamat Domisili <span class="text-red-500">*</span></label>
                    <textarea name="address" id="address" rows="3"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none resize-none" required>{{ old('address', $user->address) }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <label class="text-sm font-semibold text-gray-700 block mb-3">Status Kepemilikan Paspor <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors {{ old('hasPassport', $user->hasPassport) == 1 ? 'border-green-500 bg-green-50/50 ring-1 ring-green-500' : 'border-gray-200' }}">
                        <input type="radio" name="hasPassport" value="1" class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300" {{ old('hasPassport', $user->hasPassport) == 1 ? 'checked' : '' }}>
                        <div class="ml-3">
                            <span class="block text-sm font-bold text-gray-900">Sudah Ada Paspor</span>
                            <span class="block text-xs text-gray-500">Jamaah telah memiliki dokumen paspor aktif.</span>
                        </div>
                    </label>

                    <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors {{ old('hasPassport', $user->hasPassport) == 0 ? 'border-red-500 bg-red-50/50 ring-1 ring-red-500' : 'border-gray-200' }}">
                        <input type="radio" name="hasPassport" value="0" class="w-5 h-5 text-red-600 focus:ring-red-500 border-gray-300" {{ old('hasPassport', $user->hasPassport) == 0 ? 'checked' : '' }}>
                        <div class="ml-3">
                            <span class="block text-sm font-bold text-gray-900">Belum Ada Paspor</span>
                            <span class="block text-xs text-gray-500">Jamaah perlu mengurus pembuatan paspor.</span>
                        </div>
                    </label>
                </div>
            </div>

        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
            <a href="{{ route('users.show', $user->id) }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-colors text-center shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>

    <div class="mt-6 flex gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl text-blue-800 text-sm">
        <i class="fas fa-info-circle mt-0.5 text-lg"></i>
        <div>
            <p class="font-bold">Catatan:</p>
            <ul class="list-disc list-inside mt-1 space-y-1 text-blue-700">
                <li>Pastikan Nomor WhatsApp aktif untuk keperluan konfirmasi.</li>
                <li>Perubahan data akan langsung tersimpan di sistem.</li>
                <li>Untuk mengubah dokumen fisik (Foto KTP/KK), silakan gunakan menu Dokumen di halaman detail.</li>
            </ul>
        </div>
    </div>

</div>

<script>
    // Auto dismiss success alert
    const alertBox = document.getElementById('success-alert');
    if(alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = 0;
            setTimeout(() => alertBox.remove(), 500);
        }, 4000);
    }
</script>

</body>
</html>
