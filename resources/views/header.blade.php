<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ブログ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="{{ route('blogs') }}">ブログ一覧 <span class="sr-only"></span></a>
        <a class="nav-item nav-link" href="{{ route('create') }}">ブログ投稿</a>
      </div>
    </div>
  </div>
</nav>
