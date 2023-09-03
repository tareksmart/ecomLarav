<?php

namespace App\Http\Requests;

use App\Models\category;
use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /*فحص الريكويست اللى جاى عن طريق متسجل ام لا */
    public function authorize(): bool
    {
        return true;//خليناها ترو لحد مانظبط authorize
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // لوعايز تاخد اى بيان من اى حقل من الرريكويست بنستخدم
       // $this->input('name'); this تعود على الكلاس اللى احنا فيه اللى هو ريكويست
       //لما نجى نستخدمه بدلامن $request
        $id=$this->route('category');//بنسحب البارامتر من الروتر سواء تعديل او حذف اللى هو category
        return [
            category::rules($id)
        ];
    }
}
