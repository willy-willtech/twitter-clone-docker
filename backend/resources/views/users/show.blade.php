@extends('layouts.user')
@section('content')

  @foreach($tweets as $tweet)
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
  @endforeach

@endsection