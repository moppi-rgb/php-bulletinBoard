FROM php:8.3-apache

# MySQLに接続するための拡張機能をインストールする魔法のコマンド
RUN docker-php-ext-install pdo_mysql
