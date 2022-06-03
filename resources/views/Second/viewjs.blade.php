@extends('layouts/main_layout')
 
@section('title', 'DB表示')

@include('layouts/header_layout')

@section('content')
<script>
    function doAction(){
        var id = document.querySelector('#id').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','/second/json/'+id,true);
        xhr.responseType = 'json';
        xhr.onload = function(e){
            if(this.status ==200){
                var result = this.response;
                document.querySelector('#name').textContent=result.name;
                document.querySelector('#mail').textContent=result.mail;
                document.querySelector('#age').textContent=result.age;
            }
        };
        xhr.send();
    }
</script>


<div class="input-group ">
    <input type="number" class="form-control" placeholder="UserID" aria-label="UserID" id='id' aria-describedby="basic-addon1">
    <button class="btn btn-outline-secondary" type="button" id='id' onclick = "doAction();">検索</button>
</div>

<ul class="list-group">
    <li class="list-group-item">{{$msg}}</li>
    <li class="list-group-item" id="name">名前</li>
    <li class="list-group-item" id="mail">メールアドレス</li>
    <li class="list-group-item" id="age">年齢</li>

</ul>
<hr>
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
@endsection

