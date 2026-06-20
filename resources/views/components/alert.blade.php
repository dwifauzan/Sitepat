<div class="{{ $classes() }}" role="alert">
    <div class="flex items-start gap-3">
        <div class="flex-1 text-sm">
            {{ $message ?? $slot }}
        </div>
        @if ($dismissible)
            <button type="button" onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-current opacity-50 hover:opacity-100 transition-opacity">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        @endif
    </div>
</div>
