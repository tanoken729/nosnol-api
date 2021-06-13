<?php
return [
  // CORSヘッダーを出力するパスのパターン、任意でワイルドカード(*)が利用できる。
  //全てのルートを対象にする場合: ['*']
  //APIと特定の画像を対象にする例: ['api/*', 'resources/example.png']
 'paths' => ['*'],

  // マッチするHTTPメソッド。 `[*]` だと全てのリクエストにマッチする。
  //GETとPOSTだけを許可する場合: ['GET', 'POST']
 'allowed_methods' => ['*'],

  // 許可するリクエストオリジンの設定
  //`*`かオリジンに完全一致、またはワイルドカードが利用可。
 'allowed_origins' => ['*'],

  //正規表現によるオリジン指定。preg_matchの引数としてそのまま渡される。
 'allowed_origins_patterns' => [],

 // Access-Control-Allow-Headers response header　レスポンスヘッダーの指定
 'allowed_headers' => ['*'],

 //Access-Control-Expose-Headers レスポンスヘッダーの指定
 'exposed_headers' => false,

 //Access-Control-Max-Age レスポンスヘッダーの指定
 'max_age' => false,

 // Access-Control-Allow-Credentialsヘッダーを設定する。
 //falsy値を指定すると出力せず、truthyな値を渡せばtrueが出力される
 'supports_credentials' => false,
];