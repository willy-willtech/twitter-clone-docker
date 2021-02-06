$(function () {
  let like = $('.tweet-like-toggle'); //like-toggleのついたiタグを取得し代入。
  let likeTweetId; //変数を宣言（なんでここで？）
  like.on('click', function () { //onはイベントハンドラー
    let $this = $(this); //this=イベントの発火した要素＝iタグを代入
    likeTweetId = $this.data('tweet-id'); //iタグに仕込んだdata-review-idの値を取得
    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/tweets/like', //通信先アドレスで、このURLをあとでルートで設定します
      method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
      data: { //サーバーに送信するデータ
        'tweet_id': likeTweetId //いいねされた投稿のidを送る
      },
    })
    //通信成功した時の処理
    .done(function (data) {
      $this.toggleClass('liked'); //likedクラスのON/OFF切り替え。
      $this.next('.like-counter').html(data.tweet_likes_count);
    })
    //通信失敗した時の処理
    .fail(function () {
      console.log('fail'); 
    });
  });
  });