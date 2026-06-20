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
        $base = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

        $variants = [
            'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
            'secondary' => 'bg-danger-600 text-white hover:bg-danger-700 focus:ring-danger-500',
            'outline-primary' => 'border-2 border-primary-600 text-primary-600 hover:bg-primary-50 focus:ring-primary-500',
            'outline-secondary' => 'border-2 border-danger-600 text-danger-600 hover:bg-danger-50 focus:ring-danger-500',
            'ghost' => 'text-slate-600 hover:bg-slate-100 focus:ring-slate-400',
            'danger' => 'bg-danger-600 text-white hover:bg-danger-700 focus:ring-danger-500',
        ];

        $sizes = [
            'sm' => 'px-3 py-1.5 text-sm',
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
