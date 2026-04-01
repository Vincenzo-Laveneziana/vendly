<div x-data="{ openModal: false }">
    
    <div class="mx-4 md:mx-auto max-w-7xl"> 
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col relative">

            <div class="p-6 md:p-10 lg:p-12 border-b border-gray-50">
                <h1 class="text-xl md:text-4xl font-extrabold text-gray-900 leading-tight first-letter:uppercase">
                    {{ auth()->user()->name }} {{ auth()->user()->surname }}
                </h1>
                <p class="text-sm md:text-lg text-gray-500 font-medium">
                    Utente dal: {{ auth()->user()->created_at ? auth()->user()->created_at->format('d/m/Y') : 'Non specificata' }}
                </p>
            </div>

            <div class="p-6 md:p-10 lg:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    <div>
                        <span class="text-[10px] md:text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-sm">mail</span> Email
                        </span>
                        <p class="text-sm md:text-lg text-gray-700 font-medium">
                            {{ auth()->user()->email ?? 'Email non specificata' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-[10px] md:text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-sm">call</span> Telefono
                        </span>
                        <p class="text-sm md:text-lg text-gray-700 font-medium">
                            {{ auth()->user()->phone ?? 'Non specificato' }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <span class="text-[10px] md:text-xs text-gray-400 uppercase font-bold tracking-wider flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-sm">location_on</span> Indirizzo completo
                        </span>
                        <p class="text-sm md:text-lg text-gray-700 font-medium">
                            @if(isset(auth()->user()->address))
                                {{ auth()->user()->address['street'] ?? '' }} {{ auth()->user()->address['number'] ?? '' }}, 
                                {{ auth()->user()->address['city'] ?? '' }}
                            @else
                                Indirizzo non specificato
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-8 md:mt-12 flex justify-end">
                    <button @click="openModal = true" 
                        class="text-[14px] md:text-xl inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 md:py-3 px-4 md:px-8 rounded-xl transition-all shadow-md active:scale-95">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        Modifica Profilo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="openModal" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-6" 
        x-cloak
        x-transition.opacity>
        
        <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="openModal = false"></div>

        <div class="relative bg-white rounded-2xl border border-gray-100 shadow-2xl w-full max-w-2xl max-h-[95vh] overflow-y-auto p-5 md:p-10" @click.stop>
            
            <div class="text-center mb-4 md:mb-8">
                <h1 class="text-lg md:text-3xl font-bold text-gray-900">Modifica Utente</h1>
                <p class="text-gray-500 text-[10px] md:text-sm mt-1">Aggiorna le tue informazioni</p>
            </div>

            <form action="#" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Nome</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Cognome</label>
                        <input type="text" name="surname" value="{{ auth()->user()->surname }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Telefono</label>
                        <input type="text" name="phone" value="{{ auth()->user()->phone }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Data di nascita</label>
                        <input type="text" name="date_of_birth" value="{{ auth()->user()->date_of_birth ?? '' }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Via</label>
                        <input type="text" name="address[street]" value="{{ auth()->user()->address['street'] ?? '' }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Città</label>
                        <input type="text" name="address[city]" value="{{ auth()->user()->address['city'] ?? '' }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">CAP</label>
                        <input type="text" name="address[zip_code]" value="{{ auth()->user()->address['zip_code'] ?? '' }}" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Password Vecchia</label>
                        <input type="password" name="password" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[9px] md:text-[10px] font-bold uppercase text-gray-400 mb-0.5 ml-1">Password Nuova</label>
                        <input type="password" name="new_password" class="w-full px-3 py-1.5 md:px-4 md:py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:outline-none focus:border-gray-900 transition text-sm">
                    </div>
                </div>

                <div class="mt-5 md:mt-10 flex flex-col md:flex-row gap-2">
                    <button type="button" @click="openModal = false" class="order-2 md:order-1 flex-1 py-2 text-gray-500 font-bold hover:underline text-xs md:text-base">Annulla</button>
                    <button type="submit" class="order-1 md:order-2 flex-[2] bg-gray-900 text-white font-bold py-2.5 rounded-xl hover:bg-gray-800 transition text-sm md:text-base">Salva modifiche</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>