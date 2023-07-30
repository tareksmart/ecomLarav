@extends('layout.dashboard')
@section('title','category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">starter page</li>
@endsection

@section('content')
  <table class="table">
    <thread>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>created at</th>
            <th></th>
        </tr>
    </thread>
    <tbody>
        @foreach ($category as $item)
        <tr>
            <td>{{item->Name}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    
    </tbody>
  </table>

@endsection
