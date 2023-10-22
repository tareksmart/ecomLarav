@extends('layout.dashboard')
@section('title','category')

@section('content')
{{-- <div class="wrapper"> --}}
<div class="mb-5">
    <a href="{{route('dashboard.category.create')}}" class="btn btn-sm btn-outline-primary">create</a>
    </div>
    {{-- قيمة السيشن المرسلة عن طريق دالة with --}}
@if (session()->has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif

@if (session()->has('info'))
    <div class="alert alert-info">
        {{session('info')}}
    </div>

@endif
<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
<x-form.input name="name" placeholder="name" :value="request('name')" class="mx-2"/>
<select name="status" id="" class="form-control mx-2" >
<option value="">all</option>
{{--
    @selected(request('status')=='active')
    بعد الضغط على فلنر مايخفيش المحدد يعنى اخترت اكتيف وضغطت فلتر يخلى كلمة اكتيف محددة
     متروحش كذلك فوق عند قيمة الاسم جبنا الاسم
    المبحوث عنه من الريكيست بارامتر
    
    --}}
<option value="active" @selected(request('status')=='active')>active</option>
<option value="archived" @selected(request('status')=='archived')>archived</option>
</select>
<button class="btn btn-dark mx-2">filter</button>
</form>
  <table class="table">
    <thread>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>status</th>
            <th>Parent</th>
            <th>created at</th>
            <th colspan="2"></th>
        </tr>
    </thread>
    <tbody>
        @forelse ($categories as $item)
        <tr>
            <td><img src="{{asset('storage/'. $item->image)}}" alt="" height="60"></td>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->parent_name}}</td>
            <td>{{$item->created_at}}</td>
            <td>
                <a href="{{route('dashboard.category.edit',$item->id)}}" class="btn btn-sm btn-outline-success">Edite</a>
            </td>
            <td>
                {{--$item->id تم ارساله براوت التعديل والحذف لانه مطلوب--}}
                <form action="{{route('dashboard.category.destroy',$item->id)}}" method="post">
                @csrf
                {{-- to make post method do delete methode like aroute
                    @method لتحويل عمل الروت
                    post
                    الى
                    delete
                    --}}
                @method('delete')
                <button class="btn-sm btn-outline-danger">delete</button>

                </form>
            </td>
        </tr>
        {{--لو جدول ال cat فاضى  --}}
        @empty
<tr>
    <td colspan="9">
        no categories define
    </td>
</tr>
@endforelse

    </tbody>
  </table>
{{-- </div> --}}
{{$categories->withQueryString()->links()}}{{--لاظهار السابق والتالى تبع الباجينيشن
    لاظهار شكل بوتستراب لان ده بياخد من التالويند نروح على الفولدر
    app->providers->appserviceprovider
    withQueryString حفظ البرامترات موجوده باليو ار ال--}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection


