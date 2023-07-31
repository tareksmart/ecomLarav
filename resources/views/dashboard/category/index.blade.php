@extends('layout.dashboard')
@section('title','category')


@section('content')
<div class="mb-3">
    <a href="{{route('category.create')}}" class="btn btn-sm btn-outline-primary">create</a>
    </div>
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
            <td>{{$item->ID}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->parentId}}</td>
            <td>{{$item->created_at}}</td>
            <td>
                <a href="{{route('category.edit')}}" class="btn btn-sm btn-outline-success">Edite</a>
            </td>
            <td>
                <form action="{{route('category.destroy')}}" method="post">
                @csrf
                {{-- to make post method do delete methode like aroute --}}
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

@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

    
