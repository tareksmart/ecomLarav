@extends('layout.dashboard')
@section('title','create')


@section('content')
<div class="wrapper">
 
<form action="{{route('dashboard.category.store')}}" method="post" enctype="multipart/form-data">
@csrf
@include('dashboard.category._form')
</form>

</div>
@endsection
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">categories</li>
<li class="breadcrumb-item active">create category</li>
@endsection