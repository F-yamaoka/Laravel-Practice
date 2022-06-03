@extends('layouts/main_layout')
 
@section('title', '住所一覧')

@include('layouts/header_layout')

@section('content')
@isset($msg)
<ul class="list-group">
  <li class="list-group-item">{{$msg}}</li>
</ul>
<hr>
@endisset
  <form action = '/zipcode/view' method ='post'>
    @csrf
    〒 <input type="text" placeholder="000"  maxlength="3" name ='zipcode1'> - <input type="text" placeholder="0000"  maxlength="4" name ='zipcode2'>
    <input type="submit" value ='send'>
  </form>



<table class="table">
    <thead>
      <tr>
        <th scope="col">address1</th>
        <th scope="col">address2</th>
        <th scope="col">address3</th>
        <th scope="col">kana1</th>
        <th scope="col">kana2</th>
        <th scope="col">kana3</th>
        <th scope="col">zipcode</th>
        <th scope="col">created_at</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data as $item)
      <tr>
        <td>{{$item->address1}}</td>
        <td>{{$item->address2}}</td>
        <td>{{$item->address3}}</td>
        <td>{{$item->kana1}}</td>
        <td>{{$item->kana2}}</td>
        <td>{{$item->kana3}}</td>
        <td>{{$item->zipcode}}</td>
        <td>{{$item->created_at}}</td>
        <td><a class= "btn btn-outline-danger" role="button" href ='/zipcode/view/delete/{{$item->id}}'>Delete</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>



      
@endsection