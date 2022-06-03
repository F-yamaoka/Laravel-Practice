@extends('layouts/main_layout')
 
@section('title', 'リクエストページ')

@include('layouts/header_layout')

@section('content')
<p>{{$msg}}</p>
<form action = "/request" method = "post">
    @csrf
    <input type = "text" name ="msg">
    <input type ="submit">
</form>


@endsection
  
{{-- p53まで --}}