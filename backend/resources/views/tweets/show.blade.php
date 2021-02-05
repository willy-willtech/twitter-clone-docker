@extends('layouts.app')

@section('content')
  <div class="tweets-container">
  
    <div class="tweet-header ">
      <a  href="{{ route('users.show', ['user' => $tweet->user_id]) }}" class="tweeter-name">{{ $tweet->user->name }}</a>
      @if($tweet->user_id == Auth::id())
        <div class="edit-nav">
          <a href="{{ route('tweets.edit', ['tweet' => $tweet->id]) }}" class="tweet-edit p-2" >編集</a>
          <form
            style="display: inline-block;"
            method="POST"
            action="{{ route('tweets.destroy', ['tweet' => $tweet->id]) }}"
        >
            @csrf
            @method('DELETE')

            <button class="tweet-destroy p-2 btn-danger">削除</button>
        </form>
        </div>
      @endif
      
    </div>
    
    <div class="tweet-content "><p>{{ $tweet->body }}</p></div>
    <div class="tweet-time ">{{ $tweet->created_at }}</div>
  </div>

  <div class="tweets-container post">
      @if($errors->any())
          <ul >
            @foreach($errors->all() as $message)
              <li>{{ $message }}</li>
            @endforeach
          </ul>
      @endif
    <form action="{{ route('tweets.comments.store', ['tweet' => $tweet->id]) }}" method="post">
        @csrf
      <div class="tweet-header ">
        <p class="tweeter-name">新規コメント</p>
      </div>
      <input type="text" name="body" class="tweet-content text-box">
      <div class="tweet-button"><button type="submit" class="btn btn-primary">コメント</button></div>
    </form>
  </div>

  @foreach($comments as $comment)
  <div class="tweets-container">
  
    <div class="tweet-header ">
      <a  href="{{ route('users.show', ['user' => $comment->user_id]) }}" class="tweeter-name">{{ $comment->user->name }}</a>
      @if($comment->user_id == Auth::id())
        <div class="edit-nav">
          <a href="{{ route('tweets.comments.edit', ['tweet' => $tweet->id, 'comment' => $comment->id]) }}" class="tweet-edit p-2" >編集</a>
          <form
            style="display: inline-block;"
            method="POST"
            action="{{ route('tweets.comments.destroy', ['tweet' => $tweet->id, 'comment' => $comment->id]) }}"
        >
            @csrf
            @method('DELETE')

            <button class="tweet-destroy p-2 btn-danger">削除</button>
        </form>
        </div>
      @endif
      
    </div>
    
    <div class="tweet-content "><p>{{ $comment->body }}</p></div>
    <div class="tweet-time ">
      <p class="">{{ $comment->created_at }}</p>
    </div>
    
  </div>
  @endforeach

@endsection