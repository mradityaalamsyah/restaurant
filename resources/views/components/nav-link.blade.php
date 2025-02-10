<!-- resources/views/components/nav-link.blade.php -->
@props(['href'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'nav-link']) }}>
    {{ $slot }}
</a>
