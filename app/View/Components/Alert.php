<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public string $variant;
    public ?string $message;
    public bool $dismissible;

    public function __construct(string $variant = 'info', ?string $message = null, bool $dismissible = true)
    {
        $this->variant = $variant;
        $this->message = $message;
        $this->dismissible = $dismissible;
    }

    public function classes(): string
    {
        $variants = [
            'success' => 'bg-green-50 border-green-200 text-green-800',
            'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
            'danger' => 'bg-red-50 border-red-200 text-red-800',
            'info' => 'bg-blue-50 border-blue-200 text-blue-800',
        ];

        return 'p-4 rounded-lg border ' . ($variants[$this->variant] ?? $variants['info']);
    }

    public function render()
    {
        return view('components.alert');
    }
}
