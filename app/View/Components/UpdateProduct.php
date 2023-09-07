<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected $product,protected $options)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.update-product')->with(['product'=>$this->product,'options'=>$this->options]);
    }
}
