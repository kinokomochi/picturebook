# いきもの投稿図鑑
http://pictureboook.sakura.ne.jp/pbook/room.php
私が大学時代にあればよかったなと思ったアプリです。 当時、フィールドに出て生き物や自然観察をするサークルに所属しておりました。 サークル内でそれぞれ自分の好きなジャンルの班に所属し、全体の活動以外に班ごとの活動もありました。海班、植物班、きのこ班など。 そこで、班ごとの活動で見つけた生き物をサークル全体で共有するための図鑑を作りました。

## 機能
生き物の写真の閲覧
生き物の写真の投稿、編集、削除 
生き物の名前の検索
ログイン　サインアップ

## 使い方
以下のサンプルユーザーを使ってログインが可能です。
ログイン情報(メールアドレス、パスワード)は変更しないでください。
・メールアドレス：example@email.com
・パスワード：Password1

## DB設計

picture
 ```
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| Field       | Type         | Null | Key | Default           | Extra                       |  
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| id          | int(11)      | NO   | PRI |                   | auto_increment              |  
| sp_name     | varchar(255) | NO   |     |                   |                             |  
| picture     | varchar(255) | NO   |     |                   |                             |  
| description | text         | NO   |     |                   |                             |  
| team        | varchar(255) | NO   |     |                   |                             |  
| user_id     | int(11)      | NO   |     |                   |                             |  
| cerated     | datetime     | NO   |     | CURRENT_TIMESTAMP |                             |  
| updated     | timestamp    | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
+-------------+--------------+------+-----+-------------------+-----------------------------+  
```

user
```
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| Field       | Type         | Null | Key | Default           | Extra                       |  
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| id          | int(11)      | NO   | PRI |                   | auto_increment              |  
| nickname    | varchar(255) | NO   |     |                   |                             |  
| image       | varchar(255) | NO   |     |                   |                             |  
| introduction| text         | NO   |     |                   |                             |  
| birthday    | date         | NO   |     |                   |                             |  
| gender      | varchar(255) | NO   |     |                   |                             |  
| team        | varchar(255) | NO   |     |                   |                             |  
| password    | varchar(255) | NO   |     |                   |                             |   
| cerated     | datetime     | NO   |     | CURRENT_TIMESTAMP |                             |  
| updated     | timestamp    | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
+-------------+--------------+------+-----+-------------------+-----------------------------+  
```

## 使用言語　開発環境
macOS 10.15.4
XAMPP 7.3.12-0
PHP 7.3.11

##　今後の展望