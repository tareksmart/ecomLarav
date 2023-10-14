<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class nav extends Component
{
    //انشاء كلاس كومبوننت بينشىء كلاس فيه ملفين ملف blade viewوملف class
    /**
     * Create a new component instance.
     */
    public $items;//اى متغير بيتعرف بيتعمله تمرير اتوماتيك الى ال view المربوط بيه
    // protected $route;
    public $active;
    public $big;
    public function __construct($context)
    {
        $this->items=config('nav');//دالة configبتقرى اى ملف داخل فولدر ال config
        $this->active=Route::currentRouteName();//احضار الروت الحالى او الصفحة اللى احنا فيها حاليا
        //السطر ده ملوش لازمة بعد اضافة مفتاح اكتيف فى ملف الكونفيج
        // foreach($this->items as $item){
        //     if($this->route==$item['route'])
        //     $this->active='active';
        //     else
        //     $this->active='';
       // }
      
    $this->big=$context;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
       
        return view('components.nav');
    }
}
