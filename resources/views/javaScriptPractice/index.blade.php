@extends('layouts/main_layout')

@section('title', 'name')

@include('layouts/header_layout')

@section('content')





<button onClick = "is_your_name()">名前</button>
<button onClick = "how_old()">年齢</button>
<button onClick = "login()">ログイン</button>
<button onClick = "double()">偶数</button>
<button onClick = "is_prime_number()">素数</button>

<script>
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
  
