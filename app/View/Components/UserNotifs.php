<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserNotifs extends Component
{
    public $notif_list;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($notifs)
    {
        $this->notif_list = $notifs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $notif_list = $this->notif_list;
        return view('components.user-notifs',compact('notif_list'));
    }
}
