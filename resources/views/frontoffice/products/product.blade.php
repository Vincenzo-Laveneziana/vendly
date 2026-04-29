@extends('master')

@section('title', 'Dettagli Annuncio')

@section('content')
    <div class="min-h-screen bg-gray-50">

        @include('frontoffice.products.partials.productDetail')

        @if(auth()->user()->id != $product->user_id)
            @include('frontoffice.products.partials.createMessage')
        @endif

        <!-- Prodotti -->
        @include('frontoffice.partials.recentProducts')
    </div>
@endsection