@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <div class="text-center">
          <p>お探しのページにアクセスする権限がありません。</p>
          <a href="{{ route('tweets.index') }}" class="">
            ホームへ戻る
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection