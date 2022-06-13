<html lang="ja">
<head>
<title>@yield('title')</title>


<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
<style>
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}
 
.scroll{
    overflow-y: scroll;
}
#scroll-inner{
}

li{
  list-style:none;
}
::-webkit-scrollbar-thumb {
  background-color:rgb(125, 158, 204);
  border-radius: 5px;
}

.context{
  resize: none;
}

.form-control{
  background: rgb(245, 245, 245);
}

.background1{
  background-color:rgb(113,147,193);
  padding:1em;
  width:75%;
  height: 70%;
  overflow:auto;
  margin-left: auto;
  margin-right: auto;
}
.background2{
  background-color:rgb(255, 255, 255);
  padding:1em 1em;
  width:75%;
  height: 11%;
  overflow:auto;
  margin-left: auto;
  margin-right: auto;
}

textarea{
  resize: none;
}

.leftmessagebox{
  display: flex;
  flex-direction: row;
}

.rightmessagebox{
  display: flex;
  flex-direction: row-reverse;
}
.leftbox{
  background-color:#ebebeb;
  border-radius:25px;
  padding:10px 21px;
  margin:0 0 10px 10px;
  max-width: 75%;
  white-space:pre-wrap; 
  word-wrap:break-word;
}

.rightbox{
  background-color:#85e249;
  border-radius:25px;
  padding:10px 21px;
  margin:0 10px 10px 0;
  max-width: 75%;
  white-space:pre-wrap; 
  word-wrap:break-word;
}

.rightboxlavel{
  font-size: 80%;
  padding:10px;
  margin:0 3px -10px 0;
  max-width: 75%;
  white-space:pre-wrap; 
  word-wrap:break-word;
}
.leftboxlavel{
  font-size: 80%;
  padding:10px;
  margin:0 0 -10px 3px;
  max-width: 75%;
  white-space:pre-wrap; 
  word-wrap:break-word;
}

.rightboxdate{
  font-size: 80%;
  padding:10px;
  margin:0 -5px 0px 0px;
  max-width: 75%;
  white-space:pre-wrap; 
  word-wrap:break-word;
  margin-top: auto;
}
.leftboxdate{
  font-size: 80%;
  padding:10px;
  margin:0 0 0px -5px;
  max-width: 75%;
  white-space:pre-wrap; 
  word-wrap:break-word;
  margin-top: auto;
}


</style>   
</head>
<body>
    @yield('header')

    <div class="container">
        @yield('content')
    </div>
</div>
 
</body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"
        integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
        crossorigin="anonymous">
</script>
