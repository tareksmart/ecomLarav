@props(
[
    'options','name','checked'=>false
])

@foreach($options as $value=>$text)
<div class="form-check">
    <input class="form-check-input" type="radio" name="{{$name}}" id="" value="{{$value}}"

        @checked(old($name,$checked)==$value)
        {{
//    دمج صفات اضافية
    $attributes->class([
        'form-check-input',
        'is-invalid'=>$errors->has($name)
])
}}
    >



    <label class="form-check-label" for="">
        {{$text}}
    </label>
</div>
@endforeach
