<!-- Toast Notification Error -->
@if ($errors->any())
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 5000)" 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-8"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-8"
        class="fixed top-5 right-5 z-[100] flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-xl shadow-2xl border-l-4 border-red-500"
        role="alert"
    >
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
            <span class="material-symbols-outlined">error</span>
        </div>
        <div class="ml-3 text-sm font-normal text-gray-800">
            <span class="font-bold block text-red-600">Errore</span>
            {{ $errors->first() }}
        </div>
        <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex h-8 w-8 transition">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>
@endif

<!-- Toast Notification Success -->
@if (session('success') || session('status'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 5000)" 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-8"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        class="fixed top-5 right-5 z-[100] flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-xl shadow-2xl border-l-4 border-green-500"
    >
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <span class="material-symbols-outlined">check_circle</span>
        </div>
        <div class="ml-3 text-sm font-normal text-gray-800">
            {{ session('success') ?? session('status') }}
        </div>
        <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex h-8 w-8">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>
@endif