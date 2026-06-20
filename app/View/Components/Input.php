<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public string $type;
    public string $name;
    public ?string $label;
    public ?string $placeholder;
    public ?string $value;
    public bool $required;
    public ?string $maxlength;

    public function __construct(
        string $type = 'text',
        string $name = '',
        ?string $label = null,
        ?string $placeholder = null,
        ?string $value = null,
        bool $required = false,
        ?string $maxlength = null,
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
        $this->maxlength = $maxlength;
    }

    public function render()
    {
        return view('components.input');
    }
}
