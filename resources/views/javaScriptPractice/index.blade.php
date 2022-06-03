@extends('layouts/main_layout')

@section('title', 'name')

@include('layouts/header_layout')

@section('content')





<button onClick = "is_your_name()">名前</button>
<button onClick = "is_your_name()">名前</button>
<button onClick = "is_your_name()">名前</button>
<button onClick = "is_your_name()">名前</button>
<button onClick = "is_your_name()">名前</button>

<script>
    // 名前をアラートで入力
    function is_your_name(){
        let name = prompt('name?','');
        alert('Your name is '+ name);
    }
</script>
@endsection
  
