@extends('frontoffice.master')

@section('title', 'Dettagli Annuncio')

@section('content')
    <div class="min-h-screen bg-gray-50">

        @include('frontoffice.products.partials.productDetail')

        <!-- Prodotti -->
        @include('frontoffice.partials.recentProducts')
    </div>
@endsection