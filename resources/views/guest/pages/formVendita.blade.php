@extends('guest.master-guest')

@section('title', 'Form di Vendita')

@section('content-guest')
<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-6xl mx-auto flex flex-col-reverse md:flex-row gap-8 items-start">
        
        <div class="w-full md:w-1/3 bg-white p-6 shadow-md rounded-lg">
            <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Foto del prodotto</label>
            
            <div class="grid grid-cols-2 gap-4">
                <label for="images" class="relative cursor-pointer flex flex-col items-center justify-center h-32 w-full border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-gray-50 transition-all">
                    <div class="flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-gray-400 text-3xl">add</span>
                        <p class="text-xs text-gray-500 mt-1 font-medium">Aggiungi</p>
                    </div>
                    </label>
                
                <div id="preview-container" class="contents">
                    </div>
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

            <form action="{{ route('createPost') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <input id="images" name="images[]" type="file" class="hidden" accept="image/*" multiple onchange="previewImages(event)">

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Titolo dell'annuncio</label>
                    <input type="text" name="title" id="title" placeholder="Es: iPhone 15 Pro - Come nuovo" value="{{ old('title') }}" 
                        class="p-2.5 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror" 
                        required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrizione</label>
                    <textarea name="description" id="description" placeholder="Descrivi il prodotto, il suo stato, difetti..." rows="5" 
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
                            <input type="number" name="price" id="price" placeholder="0.00" step="0.01" value="{{ old('price') }}" 
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
                            class="p-2.5 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category') border-red-500 @enderror">
                            <option value="">Seleziona una categoria</option>
                            @foreach(\App\Models\Post::getCategoriesFromJson() as $id => $name)
                                <option value="{{ $id }}" {{ old('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end items-center gap-4 pt-6 border-t">
                    <button type="reset" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Svuota</button>
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
function previewImages(event) {
    const container = document.getElementById('preview-container');
    container.innerHTML = ''; 

    if (event.target.files) {
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = "relative h-32 w-full";
                div.innerHTML = `
                    <img src="${e.target.result}" class="h-full w-full object-cover rounded-lg border border-gray-200 shadow-sm">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center shadow-md hover:bg-red-600">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </button>
                `;
                container.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>
@endsection