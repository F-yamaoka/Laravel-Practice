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
        <th scope="col">ID</th>
        <th scope="col">NAME</th>
        <th scope="col">MAIL</th>
        <th scope="col">AGE</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data as $item)
      <tr>
        <th scope="row">{{$item->id}}</th>
        <td>{{$item->name}}</td>
        <td>{{$item->mail}}</td>
        <td>{{$item->age}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
{{-- <form action method = 'get' >
    <input type ='text' name = 'id'>
    <input type = 'submit'>
</form> --}}
@endsection