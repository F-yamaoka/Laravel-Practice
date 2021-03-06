@extends('layouts/main_layout')

@section('title', 'name')

@include('layouts/header_layout')

@section('content')
<button class="btn btn-outline-primary" onClick = "is_your_name()">名前</button>
<button class="btn btn-outline-primary" onClick = "how_old()">年齢</button>
<button class="btn btn-outline-primary" onClick = "login()">ログイン</button>
<button class="btn btn-outline-primary" onClick = "double()">偶数</button>
<button class="btn btn-outline-primary" onClick = "is_prime_number()">素数</button>
<button class="btn btn-outline-primary" onClick = "objectPractice()">オブジェクト</button>
<button class="btn btn-outline-primary" onClick = "ObjectReference()">参照</button>
<button class="btn btn-outline-primary" onClick = "OP1()">オプショナルチェイニング（プロパティ）</button>
<button class="btn btn-outline-primary" onClick = "OP2()">オプショナルチェイニング（メソッド）</button>
<button class="btn btn-outline-primary" onClick = "primitive()">primitive</button>
<button class="btn btn-outline-primary" onClick = "checkNumCall()">0 か NULL か NaN か 数値か</button>
<button class="btn btn-outline-primary" onClick = "random()">ランダム(最大,最小)</button>
<button class="btn btn-outline-primary" onClick = "ucFirstCall()">最初の文字を大文字にする</button>
<button class="btn btn-outline-primary" onClick = "inputText()">長すぎる文字列の短縮</button>
<button class="btn btn-outline-primary" onClick = "inputSum()">数字が続く限り足し続ける</button>

<script>
// JavaScript Here
// 数字が続く限り足し続ける関数
function inputSum(){
    let num =[];
    let value = 0;
    while(1){
        value = prompt('input',0);
        if (value==="" || value===null || !isFinite(value))break;
        num.push(value);
    }

    let sum = 0;
    for (let item of num){
        sum += +item;
    }
    alert(sum);
}

    // 長すぎる文字列を省略する関数
function inputText(){
  let longStr = prompt('long long text :','');
  let shortStr = truncate(longStr,20);
  alert(shortStr);
}
// 長すぎる文字列を省略する関数
function truncate(str, maxlength){
  return (str.length > maxlength)?
  str.slice(0,maxlength-1) + '…' : str;
}

// 最初の文字を大文字に
function ucFirstCall(){
  str = prompt('入力:','');
  alert(ucFirst(str));
}
// 最初の文字を大文字に
function ucFirst(str){
  // 空文字除外
  if( !str ) return str;
  return str[0].toUpperCase()+str.slice(1);
}

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

function random(max = undefined, min = undefined){
  while (!isFinite(max)) {
    max = prompt('max value?','');
  }
  while (!isFinite(min)) {
    min = prompt('min value?','');
  }

  // error
  if (max === null || min === null) {
    alert ('error : max or min is null.');
    return;
  }
  if (max === ''|| min === '') {
    alert ('error : max or min is empty');
    return;
  }
  if (max == min){
    alert ('error : max = min.');
    return;
  }
  if (max < min){
    alert (min +','+ max);
    alert ('error : max < min.');
    return;
  }
  
  // 乱数生成
  result1 = +min + Math.random() * (max - min);
  result2 = +min + Math.random() * (max - min);
  result3 = +min + Math.random() * (max - min);

  // 出力
  alert(
    'max:' + max 
  + '\nmin' + min 
  + '\n乱数1 : ' + result1
  + '\n乱数2 : ' + result2
  + '\n乱数3 : ' + result3
  );
  return;
}
// 素数チェック（入力）
function is_prime_number(){
    let number = Number(prompt('number?',''));
    if(Number.isInteger(number)){
        alert(isPrime(number) ? 'prime':'NOT prime');
    }else{
    alert('not Number');
    }
}

// 素数チェック（判断）
function isPrime(number){
    if(number == 1 || number == 0)return 0;
    for(let i = 2 ; i < number ; i++){
        if(number % i == 0)return 0;
    }
    return 1;
}

//入力値 +10までの偶数を出力　数字以外ならキャンセル
function double(){
    let value = 0;
    let msg ='';
    value = Number(prompt('input number',0));
    alert(value);
    if(Number.isInteger(value)){
        for(let i = 0 ;i<10 ;i++){
            alert(value + i % 2 == 0+'\n');
            alert(value+':: '+i);
            if((value + i) % 2 == 0){
                msg += (value + i)+' ';
            } 
        }
        alert(msg);
    }
}
/*     
prompt でログインを要求するコードを書いてください。

もし訪問者が "Admin" と入力したら、パスワードのための prompt を出します。もし入力が空行または Esc の場合 – “Canceled” と表示します。別の文字列の場合は – “I don’t know you” と表示します。

パスワードは次に沿ってチェックされます:

”TheMaster" と等しい場合には “Welcome!” と表示します。
別の文字列の場合 – “Wrong password” を表示します。
空文字または入力がキャンセルされた場合には “Canceled.” と表示します */
function login() {
  let userName = prompt('what is your name?', '');
  if (userName == 'admin') {
    let password = prompt('password?', '');
    if (password == 'password') alert('admin login \n Hello'+userName);
    else alert('wrong password');
    } else {   
  alert('hello' + userName);
  }
}
                
// 名前をアラートで入力
function is_your_name() {
  let name = prompt('name?', '');
  alert('Your name is ' + name);
}

// 18歳以上の時
function how_old() {
  let old = prompt('how old are you', 0);
  let msg = old < 18 ? 'you are young' : 'you are adult';
  alert(msg);
}
</script>
@endsection

