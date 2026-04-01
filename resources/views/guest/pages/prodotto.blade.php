@extends('guest.master-guest')

@section('title', 'Dettagli Annuncio')

@section('content-guest')
<div class="min-h-screen bg-gray-50 py-12">
    
    @include('guest.partials.prodottoDettaglio')

    <!-- Prodotti -->
    <div class="my-10">

    @include('guest.partials.annunciRecenti')
    </div>
</div>
@endsection