<div
    x-data="{ open: false }"
    x-init="$watch('open', val => document.body.classList.toggle('overflow-hidden', val))"
    @keydown.escape.window="open = false"
    {{ $attributes->merge(['class' => '']) }}
>
    {{-- Trigger --}}
    <div @click="open = true">
        {{ $trigger ?? '' }}
    </div>

    {{-- Modal Backdrop --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;"
    >
        {{-- Overlay --}}
        <div
            class="fixed inset-0 bg-black/50"
            @click="open = false"
        ></div>

        {{-- Panel --}}
        <div
            class="relative w-full {{ $size === 'sm' ? 'max-w-sm' : ($size === 'lg' ? 'max-w-lg' : ($size === 'xl' ? 'max-w-2xl' : 'max-w-md')) }} max-h-[90vh] overflow-y-auto bg-white rounded-xl shadow-2xl z-10"
            @click.away="open = false"
        >
            @if ($title ?? false)
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <h3 class="text-lg font-semibold text-primary-600">{{ $title }}</h3>
                    <button type="button" @click="open = false" class="text-slate-400 hover:text-danger-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
