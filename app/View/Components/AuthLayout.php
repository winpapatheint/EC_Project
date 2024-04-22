<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class AuthLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        User::where('role','=','seller')
        return view('layouts.auth');
    }
}
