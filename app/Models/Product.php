<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    //الدالة دى بتعمل عند تشغيل الموقع تبع الخدمات البوتينج
    //يعنى بتنفذ جلوبال سكوب باى استعلام وتعممه على اى استعلام للمنتجات
    //كده اى استعلام هيتم هياخد فى حسيانه اسم المستخدم والمخزن المربوط بيه من غير اى جمل فى الكونترولر
    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $userStoreId = Auth::user()->store_id;
            if($userStoreId)
            $builder->where('store_id', '=', $userStoreId);
        });
    }
}
