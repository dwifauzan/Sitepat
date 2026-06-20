<div
    x-data="{ open: false }"
    x-init="$watch('open', val => document.body.classList.toggle('overflow-hidden', val))"
    @keydown.escape.window="open = false"
    {{ $attributes->merge(['class' => '']) }}
>
    <div @click="open = true">
        {{ $trigger ?? '' }}
    </div>

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
        <div
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
            @click="open = false"
        ></div>

        <div
            class="relative w-full {{ $size === 'sm' ? 'max-w-sm' : ($size === 'lg' ? 'max-w-lg' : ($size === 'xl' ? 'max-w-2xl' : 'max-w-md')) }} max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-xl z-10"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            @if ($title ?? false)
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
                    <button type="button" @click="open = false" class="text-slate-400 hover:text-red-600 transition-colors">
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
