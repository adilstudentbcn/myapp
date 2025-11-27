@props([
    'employer' => null,
    // size in pixels – you can override per usage
    'size' => 40,
])

@php
    $logoUrl = null;

    if ($employer && $employer->logo_path) {
        $logoUrl = asset('storage/' . $employer->logo_path);
    } else {
        // fallback to default rocket logo
        $logoUrl = Vite::asset('resources/images/logo.png');
    }
@endphp

<img
    src="{{ $logoUrl }}"
    alt="{{ $employer->name ?? 'Employer logo' }}"
    class="rounded-xl object-cover bg-white/5"
    style="width: {{ $size }}px; height: {{ $size }}px;"
>
