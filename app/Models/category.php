<?php

namespace App\Models;

use App\Rules\customFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;


class category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $_fillable = ['name', 'parentId', 'description', 'status', 'slug'];
    protected $guarded = ['_token'];
    //هنا الفالىديت لو حصل exception
    // مش هيكمل باقى الاكواد تحت
    //وبيمسح خانات الادخال من الفورمة بيخزنها مؤقتا فى Session
    //ممكن نسحب البينات عن طريق session('session name).get()
    //لكن فى دالة اسمها old بترجع الداتا من الsession
    ///سكوب بسيط لازم كلمة scope تكون موجوده
    // public function scopeStatus(EloquentBuilder $builder,$status)
    // {
    //     $builder->where('status', '=', $status);
    // }
    public function scopeFilter(EloquentBuilder $builder, $filter)
    {
        // if($filter['name']??false){
        //     $builder->where('name','LIKE',"%{$filter['name']}%");
        // }
        // if($filter['status']??false){
        //     $builder->where('status','=',$filter['status']);
        // }
        //when(name=value يوجد قيمة,function($bulder,قيمة اللى جاية من name))
        $builder->when($filter['name'] ?? false, function ($builder, $value) {
            $builder->where('category.name', 'LIKE', "%{$value}%");
        });
        $builder->when($filter['status'] ?? false, function ($builder, $value) {
            $builder->where('category.status', '=', $value);
        });
    }
    public static function rules($id): array
    {
        return [
            'name' => [
                'string', 'required', 'min:3', 'max:255',
                Rule::unique('category', 'name')->ignore($id),
                function ($attribute, $value, $fails) { //قاعده او رول خاصة داخل الحقل name
                    if (strtolower($value) == 'laravel') { //$value القيمة اللى جايه من الحقل
                        $fails("forbidden $attribute"); //$fails عبارة عن دالة بترجع رسالة الخطا $attribute اسم الحقل اللى فيه المشكلة
                    }
                }, new customFilter(['php', 'dart', 'flutter'])
            ], //make name column unique except category that will edited
            'parenId' => ['int', 'exists:category,id'], //لازم id فى جدول التصنيف يكوم موجود
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'], //نوع صورة- حجم اقل من 1ميجا-ابعاد 100 عرض 100طول اقل حاجة
            'status' => [
                'in:active,archived',
                'required'
            ], //in عبارة قائمة

        ];
    }
}
