## 実装中に学習した内容（都度更新予定）
- WSL2上でのLAMP環境のDocker構築
- FastCGIを用いたApacheとphp-fpmの通信
- 認証機能(Authファサードを用いたログイン・ログアウト)
- 認可(Policy/Gate, Middleware, Guard/Provider)
- CRUD機能(ルーティング, MVC, フォームリクエストにおける独自のバリデーションやエラーメッセージ, ルートモデルバインディング, フォーム, Blade, フラッシュメッセージやバリデーションエラーメッセージの表示, マイグレーション)
- PHPUnitでの機能テスト
- Factory / Seederでの初期データの投入
- Blade Componentsでの一部表示箇所の再利用化
- 投稿検索機能

## その他就業までに行ったこと
- AWSへのデプロイ
(※1/4時点でApache, php-fpmの連携は確認できたがDB接続で苦戦中。マイグレーションが出来ていないことが原因だと思われるため、再挑戦します。)
(ECR, ECS on Fargate, IGW, RDSの構成)
- SQL, Dockerの復習

## 実装(+学習)する予定の内容
- CSVデータのインポート/エクスポート
- メール関連機能
- パスワードリセット機能
- フロントエンドとの連携
- AWSへのデプロイ(ECS on Fargate)
- CI/CD

## LAMP環境
開発環境は、**Apache, php-fpm(Laravel), MySQLを各コンテナに載せて構築**しています。

### 処理の流れ
静的ファイルの場合はApacheがそのまま静的ファイルを返し、静的ファイル以外はphp-fpm側に処理を投げてレスポンスの内容をクライアント側に返すような設定をApacheの設定ファイル`httpd.conf`に記載。

1. `/about`が打ち込まれる
2. Webサーバー(Apache)にリクエストが送信される
3. `httpd.conf`の`DocumentRoot`に基づいて、`var/www/html/public/about`を探す
4. `httpd.conf`の設定によって、静的ファイル以外はindex.phpに集約される

```
    # 静的ファイルのリクエストURL以外はindex.phpに集約
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
```

5. `httpd.conf`の設定によって、appコンテナのphp-fpmにFastCGIプロトコルで処理が投げられる

```
    # .phpに関してPHP-FPMに処理を投げる
    <FilesMatch \.php$>
        SetHandler "proxy:fcgi://app:9000"
    </FilesMatch>
```

6. php-fpmが`index.php`を実行
7. Laravelが`routes/web.php`でルーティングを確認
8. 該当のコントローラーに処理が振り分けられる or ビューファイルがHTMLとして返る
9. Apache経由でHTMLがクライアント側にレスポンスされる
10. クライアント側がHTMLをレンダリングしてページ表示
