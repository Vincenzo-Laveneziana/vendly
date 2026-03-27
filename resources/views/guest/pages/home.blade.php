@extends('guest.master-guest')

@section('title', 'Pagina 1')

@section('content-guest')
<div class="md:hidden flex flex-col items-center justify-center gap-3 w-full px-4">
    
    <div class="relative flex items-center w-full max-w-xs">
        <span class="material-symbols-outlined text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2">search</span>
        <input type="text" id="search" name="search" placeholder="Cerca Prodotto" 
               class="w-full px-4 py-2 pl-10 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
    </div>
    
    <a href="/vendere" class="flex items-center justify-center gap-2 w-full max-w-xs px-4 py-2 bg-blue-600 text-white font-semibold rounded-full border-2 border-blue-600 hover:bg-blue-700 transition duration-300">
        <span class="material-symbols-outlined text-[20px]">add</span>
        <span class="text-sm">Inserisci Annuncio</span>
    </a>
    

</div>
@endsection