<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-component');
    }

    /**
     * Check the active page
     * 
     * @param Array $pages
     * @param String $return
     * @param String|null $default
     */
    public function isPage(Array $pages, String $return, String $default = null)
    {
        foreach ($pages as $page) {
            if (request()->url() === $page) {
                return $return;
            }
        }
        return $default;
    }
}
