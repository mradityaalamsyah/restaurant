@props(['href'])

<a href="{{ $href }}" class="nav-link {{ request()->fullUrlIs($href) ? 'active' : '' }}">
    {{ $slot }}
</a>
