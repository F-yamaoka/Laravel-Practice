<html lang="ja">
<head>
<title>@yield('title')</title>


<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
<style>
p.arrow {
        padding: 10px 10px 5px 10px;
}
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}
 

::-webkit-scrollbar-thumb {
  background: rgb(190, 216, 253);
  border-radius: 5px;
}

.context{
  resize: none;
}
.background1{
background-color:rgb(113,147,193);
padding:1em;
height: 75%;
overflow:auto;
}
.background2{
background-color:rgb(113,147,193);
padding:1em;
height: 10%;
overflow:auto;
}

textarea{
  resize: none;
}

.leftbox{
display:inline-block;
position:relative;
background-color:white;
border-radius:10px;
padding:10px;
margin:0 0 10px 10px;
max-width: 75%;
float: left;
clear: both;
white-space:pre-wrap; 
word-wrap:break-word;
}
.rightbox{
display:inline-block;
position:relative;
background-color:#85e249;
border-radius:10px;
padding:10px;
margin:0 10px 10px 0;
max-width: 75%;
float: right;
clear: both;
white-space:pre-wrap; 
word-wrap:break-word;
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
