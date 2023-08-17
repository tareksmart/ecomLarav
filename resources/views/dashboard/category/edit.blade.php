@extends('layout.dashboard')
@section('title','edite')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">categories</li>
<li class="breadcrumb-item active">edit categorey</li>
@endsection
@section('content')
<div class="wrapper">
 
<form action="{{route('dashboard.category.update',$category->id)}}" method="post" enctype="multipart/form-data">
@csrf
{{-- //convert method from post to put --}}
@method('put')

@include('dashboard.category._form',[$category,$parents])
</form>

</div>
@endsection
