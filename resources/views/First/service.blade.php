@extends('layouts/main_layout')
 
@section('title', 'サービスコンテナ')

@include('layouts/header_layout')

@section('content')
<p>{{$msg}}</p>
<ul class="list-group">

@foreach($data as $item)
<li class="list-group-item">{{$item}}</li>
@endforeach
</ul>
<a href = '/service2/0' class="btn btn-primary">service2/0.blade.php</a>
<a href = '/service2/1' class="btn btn-primary">request2/1.blade.php</a>
<a href = '/service2/2' class="btn btn-primary">service2/2.blade.php</a>

@endsection
  