<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class nav extends Component
{
    //انشاء كلاس كومبوننت بينشىء كلاس فيه ملفين ملف blade viewوملف class
    /**
     * Create a new component instance.
     */
    public $items=['1'];//اى متغير بيتعرف بيتعمله تمرير اتوماتيك الى ال view المربوط بيه
    public function __construct()
    {
        $this->items=config('nav.php');//دالة configبتقرى اى ملف داخل فولدر ال config
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
}
