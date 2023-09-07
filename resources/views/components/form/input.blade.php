{{--وظيفة ال props انها بتعرف اللرافل انه فى attributes وبتفيدنا فى انه بنحطلها
defualt value
معانا ال attributes بنكتبه لوفيه attrib مش مسجل فى ال prob بيقبله عادى
--}}
@props([
        'type'=>'text',
        'name',
        'value'=>''
        ])


<input
    type="{{$type}}"
    name="{{$name}}"
    id=""
    @class([
        'form-control',
        'is-invalid'=>$errors->has($name)
])
    value="{{old($name,$value)}}"
{{$attributes}}
>
