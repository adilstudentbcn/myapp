@props([
    'href' => null,
    'active' => false,
])

@php
    $classes = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-800 text-gray-100';
    if ($active) {
        $classes .= ' border border-amber-400 bg-amber-500/10 text-amber-300';
    }
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $classes }}">
        {{ $slot }}
    </a>
@else
    <span class="{{ $classes }}">
        {{ $slot }}
    </span>
@endif
