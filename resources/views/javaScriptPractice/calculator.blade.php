@extends('layouts/main_layout')

@section('title', 'calculator')

@include('layouts/header_layout')

@section('content')
<h3>四則計算器</h3>
<input type = 'number' id = 'number1' value = '0'>
<select name='operator' id ='operator'>
  <option value="+">+</option>
  <option value="-">-</option>
  <option value="*">*</option>
  <option value="/">/</option>
  </select>
<input type = 'number' id = 'number2' value = '0'>
<button onClick ='calculator()'>=</button>
<input type ='text' id = 'result' disabled>

<br>
<h3>加算器</h3>
<input type = 'number' id = 'number3' value = '0'>
<button onClick ='doAccumulator()'>計算機その2を起動</button>
<br>
<h3>テスト</h3>
<button onClick ='testCalculator()'>計算機その1の単体test</button>

<script>
// 初期化
let number1;
let number2;
let number3;
let operator;
let result;
let msg;

// 計算機その2起動
function doAccumulator(){
  number3 = Number(document.getElementById("number3").value);
  let accumulator = new Accumulator(number3);
  accumulator.read();
  accumulator.read();
  alert(accumulator.value);
}
// 計算機その2
// 初期値にユーザーの入力を足していく
function Accumulator(startingValue){
  this.value = startingValue;
  this.read = function(){
    this.value += +prompt('how much to add?', 0);
  };
}


// 計算機生成
function calculator(){
  number1 = Number(document.getElementById("number1").value);
  number2 = Number(document.getElementById("number2").value);
  operator = document.getElementById("operator").value;
  
  document.getElementById("result").value = calculate(number1,operator,number2);
}


// 計算
function calculate(number1,operator,number2){
  result = 0;
  number1*=1;
  number2*=1;

  if (number1*0 != 0) return result = 'error';
  if (number2*0 != 0) return result = 'error';

  switch(operator){
  case '+' :
    result = number1 + number2;
  break;
  case '-' :
    result = number1 - number2;
  break;
  case '*' :
    result = number1 * number2;
    break;
  case '/' :
    if (number2 == 0) {
      if (number1 ==0) {
        result = NaN;
      } else {
        result = Infinity;
      }
    }else{
      result = number1 / number2;
    }
    break;
  }
  return result;
}

// debug 全データアラートで表示
function debugCalculator(number1,operator,number2,result) {
  msg = '' + '1 : ' + number1 + '\n2 : ' + number2 
  +'\n ope : ' + operator + '\nresult : ' + result; 
  alert(msg);
}

// 計算機のテスト
// NaN ==NaNがfalseになるので正しいテストはできない
// Infinity も同様
function testCalculator(number_of_test = 100) {
  let msg = '';
  let error = '';
  let count = 0;
  let errcount = 0;

  let num1 = 0;
  let num2 = 0;
  for(let i = 0 ; i < number_of_test ; i++) {
    num1 = Math.floor( Math.random() * Math.floor( Math.random() * 100 ));
    num2 = Math.floor( Math.random() * Math.floor( Math.random() * 100 ));
    if (calculate(num1,'+',num2) == num1 + num2) {
      msg += '(' + num1 + '+' + num2 + '=' + (num1 + num2) + ') 〇\n';
      count ++;
    }else {
      msg += '(' + num1 + '+' + num2 + '=' + (num1 + num2) + ') ×\n';
      error += '(' + num1 + '+' + num2 + '=' + (num1 + num2) + ') ×\n';
      errcount ++;
    }

    if (calculate(num1,'-',num2) == (num1 - num2)) {
      msg += '(' + num1 + '-' + num2 + '=' + (num1 - num2) + ') 〇\n';
      count ++;
    }else {
      msg += '(' + num1 + '-' + num2 + '=' + (num1 - num2) + ') ×\n';
      error += '(' + num1 + '-' + num2 + '=' + (num1 - num2) + ') ×\n';
      errcount ++;
    }

    if (calculate(num1,'*',num2) == num1 * num2) {
      msg += '(' + num1 + '*' + num2 + '=' + (num1 * num2) + ') 〇\n';
      count ++;
    }else {
      msg += '(' + num1 + '*' + num2 + '=' + (num1 * num2) + ') ×\n';
      error += '(' + num1 + '*' + num2 + '=' + (num1 * num2) + ') ×\n';
      errcount ++;
    }

    if (calculate(num1,'/',num2) == num1 / num2) {
      msg += '(' + num1 + '/' + num2 + '=' + (num1 / num2) +') 〇\n';
      count ++;
    }else {
      msg += '(' + num1 + '/' + num2 + '=' + (num1 / num2) +') ×\n';
      error += '(' + num1 + '/' + num2 + '=' + (num1 / num2) +') ×\n';
      errcount ++;
    }
  }

  if (calculate(10,'/',0)=='error') {
    msg += '(10/0=error) 〇\n';
    count ++;
  }else {
    msg += '(10/0=error) ×\n';
    error += '(10/0=error) ×\n';
    errcount ++;
  }

  if (calculate('1','+','3')==4) {
    msg += '(\'1\'+\'3\'=4) 〇\n';
    count ++;
  }else {
    msg += '(\'1\'+\'3\'=4) ×\n';
    error += '(\'1\'+\'3\'=4) ×\n';
    errcount ++;
  }

  if (calculate('a','/','b')=='error') {
    msg += '(a/b=error) 〇\n';
    count ++;
  }else {
    msg += '(a/b=error) ×\n';
    error += '(a/b=error) ×\n';
    errcount ++;
  }

  if (calculate('','+','')==0) {
    msg += '(undefined+undefined=0) 〇\n';
    count ++;

  }else {
    msg += '(undefined+undefined=0) ×\n';
    error += '(undefined+undefined=0) ×\n';
    errcount ++;
  }

  alert('__test log__\n'+ count + '(success : '
  + (count - errcount) + ' / error : ' + errcount + ')\n'
  + error);
}

</script>
@endsection
  
