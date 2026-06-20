<div class="bg-white rounded-xl shadow-sm border border-slate-200">
    @if ($title || $action)
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            @if ($title)
                <h3 class="text-lg font-semibold text-primary-600">{{ $title }}</h3>
            @endif
            @if ($action)
                <div class="flex items-center gap-2">{{ $action }}</div>
            @endif
        </div>
    @endif
    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>
</div>
