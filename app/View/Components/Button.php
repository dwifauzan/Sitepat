<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public string $variant;
    public string $size;
    public ?string $href;
    public string $type;

    public function __construct(
        string $variant = 'primary',
        string $size = 'md',
        ?string $href = null,
        string $type = 'button'
    ) {
        $this->variant = $variant;
        $this->size = $size;
        $this->href = $href;
        $this->type = $type;
    }

    public function classes(): string
    {
        $base = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2';

        $variants = [
            'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
            'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
            'outline' => 'border border-slate-300 text-slate-700 hover:bg-slate-50 focus:ring-slate-400',
            'outline-danger' => 'border border-red-600 text-red-600 hover:bg-red-50 focus:ring-red-500',
            'ghost' => 'text-blue-600 hover:underline hover:bg-blue-50 focus:ring-blue-500',
        ];

        $sizes = [
            'sm' => 'px-3 py-1.5 text-xs',
            'md' => 'px-4 py-2 text-sm',
            'lg' => 'px-6 py-3 text-base',
        ];

        return trim($base . ' ' . ($variants[$this->variant] ?? $variants['primary']) . ' ' . ($sizes[$this->size] ?? $sizes['md']));
    }

    public function render()
    {
        return view('components.button');
    }
}
