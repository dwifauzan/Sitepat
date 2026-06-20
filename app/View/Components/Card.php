<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public ?string $title;
    public ?string $action;
    public bool $padding;

    public function __construct(?string $title = null, ?string $action = null, bool $padding = true)
    {
        $this->title = $title;
        $this->action = $action;
        $this->padding = $padding;
    }

    public function render()
    {
        return view('components.card');
    }
}
