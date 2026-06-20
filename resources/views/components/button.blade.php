@if ($href)
    <a href="{{ $href }}" class="{{ $classes() }}">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes() }}">
        {{ $slot }}
    </button>
@endif
