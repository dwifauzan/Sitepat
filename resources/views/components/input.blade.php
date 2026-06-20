<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">
            {{ $label }}
            @if ($required) <span class="text-danger-500">*</span> @endif
        </label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @if ($required) required @endif
        @if ($maxlength) maxlength="{{ $maxlength }}" @endif
        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm"
    >
    @error($name)
        <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
    @enderror
</div>
