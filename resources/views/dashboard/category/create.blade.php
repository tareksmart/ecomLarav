@extends('layout.dashboard')
@section('title','create')


@section('content')
<div class="wrapper">
 
<form action="{{route('dashboard.category.store')}}" method="post">
@csrf
<div class="form-group">
<label for="categoryName">Category Name</label>
<input type="text" name="name" id="" class="form-control">
</div>
<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parentId" id="" class="form-control form-select">
        <option value="">Primary Category</option>
@foreach ($parents as $item)
<option value="{{$item->id}}">{{$item->name}}</option>
@endforeach
        
    </select>
</div>
<div class="form-group"><label for="">description</label>
<textarea name="description" id="" class="form-control"></textarea>
</div>

<div class="form-group">
    <label for="">image</label>
    <input type="file" name="image" id="" class="form-control-file">
</div>
<div class="form-group">
    <label for="">status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="" value="active" checked>
        <label class="form-check-label" for="">
        active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="" value="archived">
        <label class="form-check-label" for="">
        archived
        </label>
      </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">save</button>
</div>
</form>

</div>
@endsection
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">categories</li>
<li class="breadcrumb-item active">create category</li>
@endsection