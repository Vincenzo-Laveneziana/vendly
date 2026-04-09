@extends('guest.master-guest')

@section('title', 'Dettagli Annuncio')

@section('content-guest')
    <div class="min-h-screen bg-gray-50">

        @include('guest.partials.prodottoDettaglio')

        <!-- Prodotti -->
        @include('guest.partials.annunciRecenti')
    </div>
@endsection