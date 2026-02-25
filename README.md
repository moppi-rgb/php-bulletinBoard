# PHP簡易掲示板

Docker で動かす学習用のシンプルな PHP 掲示板です。

## 使い方

`docker-compose.yml` は親ディレクトリ（`PHP/`）にあります。

### 1 起動

```bash
cd ../
docker compose up -d --build
```

### 2 アクセス先

- 掲示板: http://localhost:8080
- phpMyAdmin: http://localhost:8081

### 3 停止

```bash
docker compose down
```

### 4 DBを初期化したいとき（全データ削除）

```bash
docker compose down -v
docker compose up -d --build
```

## `.env`（`bbs/.env`）

```env
DB_HOST=db
DB_NAME=bbs
DB_USER=user
DB_PASSWORD=password
DB_CHARSET=utf8mb4
```

## 注意

- Docker コマンドは `PHP/` で実行します（`bbs/` では実行しない）。
- `DB_HOST` は `127.0.0.1` ではなく `db` を使います（Compose サービス名）。
