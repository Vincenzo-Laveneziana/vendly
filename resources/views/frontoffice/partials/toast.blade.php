<!-- Unico Toast Dinamico -->
@if (session('message') || $errors->any())
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-8"
        x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-8"
        class="fixed top-5 right-5 z-[100] flex items-center w-full max-w-xs p-4 bg-white rounded-xl shadow-2xl border-l-4 {{ ($errors->any() || session('success') === false) ? 'border-red-500' : 'border-green-500' }}"
        role="alert">

        <!-- Icona Dinamica -->
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg {{ ($errors->any() || session('success') === false) ? 'text-red-500 bg-red-100' : 'text-green-500 bg-green-100' }}">
            <span class="material-symbols-outlined">
                {{ ($errors->any() || session('success') === false) ? 'error' : 'check_circle' }}
            </span>
        </div>

        <!-- Messaggio Dinamico -->
        <div class="ml-3 text-sm font-normal text-gray-800">
            @if($errors->any() || session('success') === false)
                <span class="block text-red-600">{{ __(session('message')) }} {{ $errors->first()}}</span>
            @else
                {{-- Se c'è 'message', lo traduciamo, altrimenti usiamo 'success' o 'status' --}}
                {{ __(session('message')) }}
            @endif
        </div>

        <!-- Tasto Chiusura -->
        <button @click="show = false"
            class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex h-8 w-8 transition">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>
@endif