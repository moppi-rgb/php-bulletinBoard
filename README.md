# PHP簡易掲示板

学習用に作成したシンプルなPHP掲示板です。
投稿データはMySQLの`bbs`テーブルに保存されます。
データベース接続については学習が浅いため、.env方式でアクセスするためのコードをGithub Copilotに出力してもらっています。

## 動作環境

- PHP 8.0以上
- MySQL / MariaDB
- Webサーバー（Laragon / Apache / Nginx など）

## 環境変数（`.env`）

```env
DB_HOST=127.0.0.1
DB_NAME=php-bulletinboard
DB_USER=root
DB_PASSWORD=your_password_here
DB_CHARSET=utf8mb4
```
