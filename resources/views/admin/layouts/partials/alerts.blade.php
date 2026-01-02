<!-- Success Alert -->
@if(session('success'))
    <div id="success-alert"
         class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-2xl mr-3"></i>
            <div>
                <p class="font-semibold">Berhasil!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
        <button onclick="closeAlert('success-alert')" class="text-green-700 hover:text-green-900">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
@endif

<!-- Error Alert -->
@if(session('error') || $errors->any())
    <div id="error-alert"
         class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-2xl mr-3"></i>
            <div>
                <p class="font-semibold">Error!</p>
                @if(session('error'))
                    <p class="text-sm">{{ session('error') }}</p>
                @endif
                @if($errors->any())
                    <ul class="text-sm list-disc list-inside mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <button onclick="closeAlert('error-alert')" class="text-red-700 hover:text-red-900">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
@endif

<!-- Warning Alert -->
@if(session('warning'))
    <div id="warning-alert"
         class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg mb-6 flex items-center justify-between shadow-md animate-fade-in">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-2xl mr-3"></i>
            <div>
                <p class="font-semibold">Peringatan!</p>
                <p class="text-sm">{{ session('warning') }}</p>
            </div>
        </div>
        <button onclick="closeAlert('warning-alert')" class="text-yellow-700 hover:text-yellow-900">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
@endif

