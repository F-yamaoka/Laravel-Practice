@extends('layouts/main_layout')

@section('title', 'calculator')

@include('layouts/header_layout')

@section('content')
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
<button onClick ='testCalculator()'>test</button>

<script>
  // 初期化
  let number1;
  let number2;
  let operator;
  let result;
  let msg;

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
        result = 'error';
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
function testCalculator() {
  let msg = '__test log__\n';
  if (calculate(1,'+',1)==2){
    msg += '(1+1=2) 〇\n';
  }else {
    msg += '(1+1=2) ×\n';
  }
  if (calculate(3,'-',1)==2){
    msg += '(3-1=2) 〇\n';
  }else {
    msg += '(3-1=2) ×\n';
  }
  if (calculate(4,'*',6)==24){
    msg += '(4*6=2) 〇\n';
  }else {
    msg += '(4*6=2) ×\n';
  }
  if (calculate(6,'/',3)==2){
    msg += '(6/3=2) 〇\n';
  }else {
    msg += '(6/3=2) ×\n';
  }
  if (calculate(10,'*',5)==50){
    msg += '(10+5=50) 〇\n';
  }else {
    msg += '(10+5=50) ×\n';
  }
  if (calculate(10,'/',0)=='error'){
    msg += '(10/0=error) 〇\n';
  }else {
    msg += '(10/0=error) ×\n';
  }
  if (calculate('1','+','3')==4){
    msg += '(\'1\'+\'3\'=4) 〇\n';
  }else {
    msg += '(\'1\'+\'3\'=4) ×\n';
  }
  if (calculate('hello','/','world')=='error'){
    msg += '(a/b=error) 〇\n';
  }else {
    msg += '(a/b=error) ×\n';
  }
  alert(msg);
}

</script>
@endsection
  
