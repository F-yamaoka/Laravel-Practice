@extends('layouts/main_layout')
@section('title', 'name')
@include('layouts/header_layout')
@section('content')

<button onClick = "objectPractice()">オブジェクト</button>
<button onClick = " "></button>
<button onClick = " "></button>
<button onClick = " "></button>
<button onClick = " "></button>

<script>
// JavaScript Here
function objectPractice(){
  let user = {
    name: 'John',
    age : 30,
  };
  user.isAdmin = true;
  alert(`let user = {
    name: 'John',
    age : 30,
    user.isAdmin = true
    }`
  );

  alert(
    'user : ' + user.name
  + ',\nname :' + user.age 
  + ',\nadmin : ' + user.isAdmin
  );
}
</script>
@endsection
  
