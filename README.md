# LAMP環境
開発環境は、**Apache, php-fpm(Laravel), MySQLを各コンテナに載せて構築**しています。

### 処理の流れ
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