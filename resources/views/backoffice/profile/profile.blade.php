@extends('frontoffice.master')

@section('title', 'Profilo')

@section('content')
    <!-- Profile Navigation Bar -->
    @include('backoffice.profile.partials.navBar')

    <div class="min-h-screen bg-gray-50 py-12" style="font-family: 'Satoshi-Regular', sans-serif;">

        @include('backoffice.profile.partials.profileDetails')

    </div>
@endsection