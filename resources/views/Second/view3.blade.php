@extends('layouts/main_layout')
 
@section('title', 'DB表示')

@include('layouts/header_layout')

@section('content')
<ul class="list-group">
    <li class="list-group-item">{{$msg}}</li>
</ul>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name[age]</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data as $item)
      <tr>
        <th scope="row">{{$item->id}}</th>
        <td>{{$item->name_and_age}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection