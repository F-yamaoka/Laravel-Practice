@extends('layouts/main_layout')
@section('title', 'name')
@include('layouts/header_layout')
@section('content')

<button onClick = "objectPractice()">オブジェクト</button>
<button onClick = "ObjectReference()">参照</button>
<button onClick = " "></button>
<button onClick = " "></button>
<button onClick = " "></button>

<script>
// JavaScript Here

// 練習1
function objectPractice(){
  let user = {
    name: 'John',
    age : 30,
  };
  user.email = 'john@gmail.com';
  user.country = 'USA';
  user.isAdmin = true;

  alert(`let user = {
    name: 'John',
    age : 30,
    user.isAdmin = true
    }`
  );

  alert(
    'user ' + user.name
  + ',\nname :' + user.age 
  + ',\nadmin : ' + user.isAdmin
  );
  alert(viewObject(user));
}

// 練習2 オブジェクト参照
function ObjectReference(){
  let message = "hello";
  // message -> hello
  
  let phrase = message;
  // phrase -> (message) -> hello

  alert(
    `  let message = "hello";
    // message -> hello
    
    let phrase = message;
    // phrase -> (message) -> hello
  `);
  let result = '';
  result += 'message : ' + message+'\nphrase : ' + phrase;

  // messageのみ更新
  message = "world";
  result += '\n let message = "world";\n';

  result += 'message : ' + message+'\nphrase : ' + phrase;
  alert(result);

  let user = {name : 'before'};
  // message -> hello
  
  let admin = user;
  // phrase -> (message) -> hello

  alert(`
    let user = {name : before};
    let admin = user;
  `);
  result = '';
  result += 'user.name : ' 
  + user.name 
  + '\nadmin.name : ' 
  + admin.name;

  // messageのみ更新
  user.name = "after";
  result += '\n user.name = "after";\n';

  result += 'user.name : ' + user.name+'\nadmin.name : ' + admin.name;
  alert(result);
}

// オブジェクトの内容を返す
function viewObject(obj){
  let msg = '__viewObject()__\n';
  for (key in obj) {
    msg += key + ' : ';
    msg += obj[key] + ',\n'; 
  }
  return msg;
}

</script>
@endsection

