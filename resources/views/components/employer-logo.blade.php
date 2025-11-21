@props(['width' => 20])

<img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo" class="rounded-xl w-{{ $width }}">



{{-- <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo" class="w-20 h-auto"> --}}