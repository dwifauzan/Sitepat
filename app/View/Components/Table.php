<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;
    public bool $striped;
    public bool $hover;
    public ?string $id;

    public function __construct(array $headers = [], bool $striped = true, bool $hover = true, ?string $id = null)
    {
        $this->headers = $headers;
        $this->striped = $striped;
        $this->hover = $hover;
        $this->id = $id ?? 'table-' . uniqid();
    }

    public function render()
    {
        return view('components.table');
    }
}
