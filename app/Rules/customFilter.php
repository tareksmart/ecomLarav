<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class customFilter implements ValidationRule
{
    protected $data;
public function __construct($dataFromRule)
{
    $this->data=$dataFromRule;

}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
//        if(strtolower($value)=='php'){
//            $fail("$attribute not allowed");
//        }
//لو القيم اللى جايه موجوده فى المصفوفة ابعت رسالة خطأ
        if(in_array(strtolower($value) ,$this->data)){

            $fail("$attribute of $value not allowed");
        }
    }


}
