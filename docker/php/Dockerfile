# PHPの実行環境
FROM php:8.3-fpm AS base

# パッケージインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# アプリケーションファイルのコピー
COPY src/ /var/www/html/
WORKDIR /var/www/html

# PHP拡張のインストール
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Node.jsのインストール
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

## 開発環境
FROM base AS development
EXPOSE 5173

# 開発用ツールのインストール
RUN composer global require "laravel/installer"

## 本番環境
FROM base AS production

# 開発用パッケージを除いたComposerの依存関係のインストール
RUN composer install --no-dev --optimize-autoloader

# npmパッケージのインストールとビルド
WORKDIR /var/www/html
RUN npm install
RUN npm run build

# 権限設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage