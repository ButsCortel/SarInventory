<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfirmModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title = '';
    public $method = '';
    public $uri = '';
    public $id = '';
    public function __construct($title, $method, $uri, $id)
    {
        $this->title = $title;
        $this->method = $method;
        $this->uri = $uri;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.confirm-modal');
    }
}
