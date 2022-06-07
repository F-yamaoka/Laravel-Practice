@section('header')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Laravel実践開発・練習</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="http://localhost:8000/zipcode/view">php郵便番号→住所</a></li>
            <a class="nav-link" href="http://localhost:8000/zipcode/reactapp">react郵便番号→住所</a></li>

            <a class="nav-link" href="http://localhost:8000/javascript/calculator">電卓</a></li>

          </li>
        </ul>
      </div>
    </div>
  </nav>
@endsection