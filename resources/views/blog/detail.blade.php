@extends('layout')
@section('title', 'ブログ詳細')
@section('content')
<div class="row">
  <div class="col-md-12 py-5 col-md-offset-2">
    <h2>{{ $blog->title }}</h2>
    <span>作成日：{{ $blog->created_at }}</span>
    <span>更新日：{{ $blog->updated_at }}</span>
    <div>{{ $blog->content }}</div>
  </div>
</div>
@endsection
