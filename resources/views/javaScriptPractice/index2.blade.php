@extends('layouts/main_layout')
@section('title', 'name')
@include('layouts/header_layout')
@section('content')

<button onClick = "objectPractice()">オブジェクト</button>
<button onClick = "ObjectReference()">参照</button>
<button onClick = "OP1()">オプショナルチェイニング（プロパティ）</button>
<button onClick = "OP2()">オプショナルチェイニング（メソッド）</button>
<button onClick = "primitive()">primitive</button>
<button onClick = "checkNumCall()">0 か NULL か NaN か 数値か</button>
{{-- 結論: 小数部分を扱うとき、等価チェックを避けましょう。 --}}
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

// 練習3オプショナルチェイニング1
function OP1(){
  let user ={};
  alert ('オプショナルチェイニングあり(undefined)');
  alert (user?.address?.streat);
  alert ('次はオプショナルチェイニングなし(エラー発生)');
  alert (user.address.streat);
}

// 練習4オプショナルチェイニング2
function OP2(){
  // admin()を定義
  let userAdmin ={
    admin(){
      alert('i am admin (function is called)')
    }
  };

  // admin()を定義しない
  let userGuest = {};
  alert ('オプショナルチェイニングあり(undefined)');
  userAdmin.admin?.();
  userGuest.admin?.(); //これは存在しないメソッド
  alert ('次はオプショナルチェイニングなし(エラー発生)');
  userAdmin.admin();
  userGuest.admin(); //これは存在しないメソッド
}

// 練習4 シンボル
function primitive(){

  let user = {
    name : "John",
    money: 1000,

    [Symbol.toPrimitive](hint){
      alert(`hint : ${hint}`);
      return hint == "string" ? `{name: "${this.name}"}` : this.money;
    }
  };

  alert(user);
  alert(+user);
  alert(user + 500);
}

// checknumの呼び出し
function checkNumCall(){
  alert('入力したのは'+checkNum());
}

// 0 か NULL か NaN か 数値か
function checkNum(){
  let num;

  do {
    num = prompt('"数字"を入力','');
  }while ( !isFinite(num) );        // 文字を除外
  if (num === null || num === ''){  // nullと空行を除外
    return null;
  }
  return +num;

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

