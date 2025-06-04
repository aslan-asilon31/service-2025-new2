<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppBrand extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'HTML'
                <a href="/" wire:navigate>
                    <!-- Hidden when collapsed -->
                    <div {{ $attributes->class(["hidden-when-collapsed"]) }}>
                        <div class="flex items-center justify-center ">
                            <img src="{{asset('frontend/assets/img/logo.png')}}" class="w-8 md:w-16  -mb-1" alt="" srcset="">
                        </div>
                    </div>

                    <!-- Display when collapsed -->
                    <div class="display-when-collapsed hidden mx-5 mt-4 lg:mb-6 h-[28px]">
                        <div class="flex items-center gap-2 text-center ">
                            <img src="{{asset('frontend/assets/img/logo.png')}}" class="w-8 md:w-16  -mb-1" alt="" srcset="">
                        </div>
                    </div>
                </a>
            HTML;
    }
}
