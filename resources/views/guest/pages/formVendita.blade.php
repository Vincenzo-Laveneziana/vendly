@extends('guest.master-guest')

@section('title', 'Form di Vendita')

@section('content-guest')
<div class="min-h-screen bg-gray-100 py-10 px-4">
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm border border-red-200">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="max-w-6xl mx-auto flex flex-col-reverse md:flex-row gap-8 items-start">
        <div class="w-full md:w-1/3 bg-white p-6 shadow-md rounded-lg">
            <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Foto del prodotto</label>
            
            <div class="grid grid-cols-2 gap-4">
                {{-- L'attributo 'accept' nel file input sotto limiterà già la scelta nei file picker --}}
                <label for="images" class="relative cursor-pointer flex flex-col items-center justify-center h-32 w-full border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-gray-50 transition-all">
                    <div class="flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-gray-400 text-3xl">add</span>
                        <p class="text-xs text-gray-500 mt-1 font-medium">Aggiungi</p>
                    </div>
                </label>
                
                <div id="preview-container" class="contents"></div>
            </div>
            
            <div class="mt-4 p-3 bg-blue-50 rounded-md">
                <p class="text-xs text-blue-700 leading-relaxed">
                    <span class="font-bold">Suggerimento:</span> Carica almeno 3 foto da diverse angolazioni per vendere più velocemente.
                </p>
            </div>
        </div>

        <div class="w-full md:w-2/3 bg-white p-8 shadow-md rounded-lg">
            <div class="mb-8 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Crea un nuovo Post</h2>
                <p class="text-gray-500 text-sm mt-1">Inserisci i dettagli del tuo annuncio per attirare i compratori.</p>
            </div>

            <form action="{{ route('createProduct') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="postForm">
                @csrf
                
                {{-- Controlli HTML: accept limita i formati, multiple permette più file --}}
                <input id="images" name="images[]" type="file" class="hidden" accept="image/jpeg,image/png,image/webp" multiple>

                <div>
                    <div class="flex justify-between">
                        <label for="title" class="block text-sm font-medium text-gray-700">Titolo dell'annuncio</label>
                        <span id="title-char-count" class="text-xs text-gray-400">0 / 30</span>
                    </div>
                    <input type="text" name="title" id="title" maxlength="30" placeholder="Es: iPhone 15 Pro - Come nuovo" value="{{ old('title') }}" 
                        class="p-2.5 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror" 
                        required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between">
                        <label for="description" class="block text-sm font-medium text-gray-700">Descrizione</label>
                        <span id="desc-char-count" class="text-xs text-gray-400">0 / 1000</span>
                    </div>
                    <textarea name="description" id="description" maxlength="1000" placeholder="Descrivi il prodotto, il suo stato, difetti..." rows="5" 
                        class="p-2.5 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Prezzo (€)</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input type="number" name="price" id="price" placeholder="0.00" step="0.01" min="0" value="{{ old('price') }}" 
                                class="pl-8 p-2.5 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('price') border-red-500 @enderror" 
                                required>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                        <select name="category" id="category" 
                            class="p-2.5 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category') border-red-500 @enderror" required>
                            <option value="">Seleziona una categoria</option>
                            @foreach(\App\Models\Product::getCategoriesFromJson() as $id => $name)
                                <option value="{{ $id }}" {{ old('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end items-center gap-4 pt-6 border-t">
                    <button type="reset" id="resetBtn" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Svuota</button>
                    <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-all active:scale-95">
                        Pubblica Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// --- GESTIONE IMMAGINI (SOLO LOGICA FUNZIONALE) ---
let filesArray = []; 
const imagesInput = document.getElementById('images');
const container = document.getElementById('preview-container');

imagesInput.addEventListener('change', function(e) {
    const newFiles = Array.from(e.target.files);
    
    newFiles.forEach(file => {
        filesArray.push(file);

        const reader = new FileReader();
        reader.onload = function(event) {
            const div = document.createElement('div');
            div.className = "relative h-32 w-full animate-fade-in";
            div.innerHTML = `
                <img src="${event.target.result}" class="h-full w-full object-cover rounded-lg border border-gray-200 shadow-sm">
                <button type="button" class="remove-img-btn absolute -top-2 -right-2 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center shadow-md hover:bg-red-600">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                </button>
            `;
            
            div.querySelector('.remove-img-btn').onclick = function() {
                filesArray = filesArray.filter(f => f !== file);
                div.remove();
                updateInputFiles();
            };
            
            container.appendChild(div);
        }
        reader.readAsDataURL(file);
    });

    updateInputFiles();
});

function updateInputFiles() {
    const dataTransfer = new DataTransfer();
    filesArray.forEach(file => dataTransfer.items.add(file));
    imagesInput.files = dataTransfer.files;
}

// --- CONTROLLI TESTO (COUNTER) ---
const titleInput = document.getElementById('title');
const descInput = document.getElementById('description');
const titleCount = document.getElementById('title-char-count');
const descCount = document.getElementById('desc-char-count');

titleInput.addEventListener('input', () => {
    titleCount.textContent = `${titleInput.value.length} / 30`;
    titleCount.className = titleInput.value.length >= 30 ? "text-xs text-red-500 font-bold" : "text-xs text-gray-400";
});

descInput.addEventListener('input', () => {
    descCount.textContent = `${descInput.value.length} / 1000`;
    descCount.className = descInput.value.length >= 1000 ? "text-xs text-red-500 font-bold" : "text-xs text-gray-400";
});

document.getElementById('resetBtn').onclick = () => {
    filesArray = [];
    container.innerHTML = '';
    titleCount.textContent = "0 / 30";
    descCount.textContent = "0 / 1000";
};
</script>
@endsection