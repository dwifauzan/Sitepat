<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">
            {{ $label }}
            @if ($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        @if ($required) required @endif
        @error($name) aria-invalid="true" aria-describedby="{{ $name }}-error" @enderror
        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm @error($name) border-red-500 ring-2 ring-red-100 @enderror"
    >
        {{ $slot }}
    </select>
    @error($name)
        <p id="{{ $name }}-error" class="mt-1 text-xs text-red-600 flex items-center gap-1">
            <span>⚠</span> {{ $message }}
        </p>
    @enderror
</div>
