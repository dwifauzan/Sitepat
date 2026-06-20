<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public string $variant;

    public function __construct(string $variant = 'info')
    {
        $this->variant = $variant;
    }

    public function classes(): string
    {
        $variants = [
            'success' => 'bg-green-100 text-green-800',
            'warning' => 'bg-amber-100 text-amber-800',
            'danger' => 'bg-red-100 text-red-800',
            'info' => 'bg-blue-100 text-blue-800',
            'primary' => 'bg-primary-100 text-primary-800',
        ];

        return 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' . ($variants[$this->variant] ?? $variants['info']);
    }

    public function render()
    {
        return view('components.badge');
    }
}
