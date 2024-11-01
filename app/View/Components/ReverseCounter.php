<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReverseCounter extends Component
{
    public $expireDate;
    public $msgTry;
    public $msgWait;
    public $resendElem;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($expireDate,$msgTry="",$msgWait="",$resendElem="")
    {
        $this->expireDate = $expireDate;
        $this->msgTry = $msgTry;
        $this->msgWait = $msgWait;
        $this->resendElem = $resendElem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.reverse-counter');
    }
}
