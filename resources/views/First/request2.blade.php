@extends('layouts/main_layout')
 
@section('title', 'リクエストページ')

@include('layouts/header_layout')

@section('content')
<p>{{$msg}}</p>
<form action = "/request2" method = "post">
    @csrf
    <div>NAME : <input type = "text" name ="name"></div>
    <div>MAIL : <input type = "text" name ="mail"></div>
    <div>TELL : <input type = "text" name ="tel"></div>
    <input type ="submit">
</form>
<hr>
<ol>
    @for($i =0;$i<count($keys);$i++){
        <li>{{$keys[$i]}} : {{$values[$i]}}</li>
    }
    @endfor
</ol>
@endsection