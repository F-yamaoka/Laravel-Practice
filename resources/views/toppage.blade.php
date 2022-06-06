@extends('layouts/main_layout')

@section('title', 'トップページ')

@include('layouts/header_layout')

@section('content')
<style>.btn {width: 100%;}</style>
<h2>0. 郵便番号→住所</h2>
    <div class="row gap-2" >
    <div class="col-3">
    <a href = '/zipcode/view' class="btn btn-outline-primary">郵便番号から住所</a>
    </div>
<h2>1. リクエスト　ファサード</h2>
    <div class="row gap-2" >
    <div class="col-3">
    <a href = '/first/request' class="btn btn-outline-primary">request</a>
    </div><div class="col-3">
    <a href = '/first/request2' class="btn btn-outline-primary">request2</a>
    </div><div class="col-3">
    <a href = '/first/service' class="btn btn-outline-primary">service</a>
    </div><div class="col-3">
    <a href = '/first/service2' class="btn btn-outline-primary">service2</a>
    </div><div class="col-3">
    <a href = '/first/service3' class="btn btn-outline-primary">service3</a>
    </div><div class="col-3">
    <a href = '/first/service2' class="btn btn-outline-primary">middle</a>
    </div>
</div>
<hr>
<h2>2. DB クエリビルダ</h2>
<div class="row gap-2">
    <div class="col-3">
    <a href = '/second/aimai' class="btn btn-outline-primary">あいまい検索</a>
    </div><div class="col-3">
    <a href = '/second/hashi' class="btn btn-outline-primary">DBの両端を表示</a>
    </div><div class="col-3">
    <a href = '/second/pluck' class="btn btn-outline-primary">pluck</a>
    </div><div class="col-3">
    <a href = '/second/chunk' class="btn btn-outline-primary">奇数のみ</a>
    </div><div class="col-3">
    <a href = '/second/chunkOrderBy' class="btn btn-outline-primary">chunkOrderBy</a>
    </div><div class="col-3">
    <a href = '/second/whereAndOr/12,15' class="btn btn-outline-primary">指定したIDのみ</a>
    </div><div class="col-3">
    <a href = '/second/page' class="btn btn-outline-primary">ペジネーション</a>
    </div><div class="col-3">
    <a href = '/second/model' class="btn btn-outline-primary">model</a>
    </div><div class="col-3">
    <a href = '/second/reject' class="btn btn-outline-primary">reject</a>
    </div><div class="col-3">
    <a href = '/second/diff' class="btn btn-outline-primary">diff</a>
    </div><div class="col-3">
    <a href = '/second/modelKeys' class="btn btn-outline-primary">modelKeys</a>
    </div><div class="col-3">
    <a href = '/second/merge' class="btn btn-outline-primary">merge</a>
    </div><div class="col-3">
    <a href = '/second/map' class="btn btn-outline-primary">map</a>
    </div>

</div>
<hr>
<h2>3. Model</h2>
<div class="row gap-2">
    <div class="col-3">
    <a href = '/second/fields' class="btn btn-outline-primary">fields</a>
    </div>
    <div class="col-3">
    <a href = '/second/accessa' class="btn btn-outline-primary">アクセサ</a>
    </div>
    <div class="col-3">
    <a href = '/second/mutator' class="btn btn-outline-primary">ミューテタ</a>
    </div>
    <div class="col-3">
    <a href = '/second/search' class="btn btn-outline-primary">検索</a>
    </div>
</div>

<h3>~p.182</h3>

<hr>
<h2>4 JavaScript</h2>
<div class="row gap-2">
    <div class="col-3">
    <a href = '/javascript/index' class="btn btn-outline-primary">練習1</a>
    </div>
    <div class="col-3">
    <a href = '/javascript/index2' class="btn btn-outline-primary">練習2</a>
    </div>
    <div class="col-3">
    <a href = '/javascript/calculator' class="btn btn-outline-primary">calculator</a>
    </div>
</div>
@endsection
  
