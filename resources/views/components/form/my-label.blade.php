{{--الطريقة الاولى الاولىعن طريق تمرير attribute--}}

{{--@props([--}}
{{--    'labelContent'=>'label'--}}
{{--])--}}

{{--تمرير متغير--}}
{{--<label >{{$labelContent}}</label>--}}

{{--الطريق الثانيه عن طريق المتغير المعرف داخل لارافل slot ثم تضع القيمة بين التاجات عادى--}}
<label >{{$slot}}</label>
