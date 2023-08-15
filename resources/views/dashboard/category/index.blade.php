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
  <table class="table">
    <thread>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>created at</th>
            <th colspan="2"></th>
        </tr>
    </thread>
    <tbody>
        @forelse ($categories as $item)
        <tr>
            <td></td>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->parentId}}</td>
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
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection


