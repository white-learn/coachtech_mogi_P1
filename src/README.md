# COACHTECHフリマ

## アプリケーション概要

COACHTECHフリマは、商品の出品・購入・お気に入り登録・コメント機能を備えたフリマアプリです。

### 主な機能

- 会員登録
- ログイン / ログアウト
- メール認証
- プロフィール編集
- 商品一覧表示
- 商品詳細表示
- 商品出品
- 商品購入
- お気に入り登録
- コメント投稿
- 商品検索

---

## 環境構築

### Dockerビルド

Dockerコンテナを起動します。

```bash
docker compose up -d --build
```

---

### Laravel環境構築

PHPコンテナへ入ります。

```bash
docker compose exec php bash
```

Composerパッケージをインストールします。

```bash
composer install
```

src配下に.envファイルを作成し、下記をコピーする

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=senduser@send.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

STRIPE_SECRET=
```

APP_KEYを用意する

```bash
php artisan key:generate
```

マイグレーションとシーディングを実行します。

```bash
php artisan migrate:fresh --seed
```

ストレージリンクを作成します。

```bash
php artisan storage:link
```

下記のリンクにアクセスすることで操作できます。

```bash
http://localhost
```

---

## Dockerコンテナ構成

| コンテナ名 | 説明                               |
| ---------- | ---------------------------------- |
| nginx      | Webサーバー                        |
| php        | Laravelアプリケーション実行環境    |
| mysql      | データベース                       |
| phpMyAdmin | データベース管理ツール             |
| mailhog    | メール送信確認ツール               |
| selenium   | Laravel Dusk実行用ブラウザコンテナ |

---

## 使用技術（実行環境）

- PHP 8.x
- Laravel 8.x
- MySQL 8.0.26
- Nginx 1.21.1
- Docker
- phpMyAdmin
- MailHog
- Laravel Fortify
- Laravel Dusk

---

## ER図

作成したER図を添付

![ER図](mogi_ER.png)

---

## URL

### 開発環境

http://localhost

### phpMyAdmin

http://localhost:8080

### MailHog

http://localhost:8025

---

## テスト実行

### PHPUnitテスト

.env.testingと.env.duskのSTRIPE_SECRETの値を.envを参考にして入力してください。

テスト用DBを作成します。
(Mysqlコンテナ内)

```sql
mysql -u root -p (パスワードはroot)
CREATE DATABASE laravel_test;
```

テストDBへマイグレーションとシーディングを実行します。
(phpコンテナ内)

```bash
php artisan migrate:fresh --env=testing --seed --force
```

Featureテストを実行します。
(phpコンテナ内)

```bash
php artisan test
```

### Duskテストを実行します。

(phpコンテナ内)

```bash
php artisan dusk
```

特定のテストのみ実行する場合
(phpコンテナ内)

```bash
php artisan test --filter LoginTest
```

---

## テスト用アカウント

### ユーザー1

メールアドレス

```text
user1@example.com
```

パスワード

```text
password
```

### ユーザー2

メールアドレス

```text
user2@example.com
```

パスワード

```text
password
```

---

## 備考

メール認証機能は MailHog を利用しています。

認証メールは以下のURLから確認できます。

http://localhost:8025
