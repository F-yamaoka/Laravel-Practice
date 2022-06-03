@extends('layouts/main_layout')

@section('title', 'name')

@include('layouts/header_layout')

@section('content')

<script>
    let name = prompt('name?','');
    alert('Your name is '+ name);
</script>

@endsection
  
