@extends('layouts/main_layout')

@section('title', 'name')

@include('layouts/header_layout')

@section('content')



<script>
// 名前をアラートで入力
function alert(){
    let name = prompt('name?','');
    alert('Your name is '+ name);
}
</script>

<button onClick = "alert()">名前</button>


@endsection
  
