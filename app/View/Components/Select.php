<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public string $name;
    public ?string $label;
    public bool $required;

    public function __construct(
        string $name = '',
        ?string $label = null,
        bool $required = false,
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.select');
    }
}
