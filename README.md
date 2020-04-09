# いきもの投稿図鑑

私が大学時代にあればよかったなと思ったアプリです。 当時、フィールドに出て生き物や自然観察をするサークルに所属しておりました。 サークル内でそれぞれ自分の好きなジャンルの班に所属し、全体の活動以外に班ごとの活動もありました。海班、植物班、きのこ班など。 そこで、班ごとの活動で見つけた生き物をサークル全体で共有するための図鑑を作りました。

## 機能

写真の投稿、編集、削除機能 生き物の名前の検索機能 ログイン機能　サインアップ機能

※今後追加予定の機能 ユーザー管理画面　コメント機能　サイトの見た目

## DB設計

picture
 ```
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| Field       | Type         | Null | Key | Default           | Extra                       |  
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| id          | int(11)      | NO   | PRI | None              | auto_increment              |  
| sp_name     | varchar(255) | YES  |     | NULL              |                             |  
| picture     | varchar(255) | NO   |     | None              |                             |  
| description | text         | NO   |     |                   |                             |  
| team        | varchar(255) | NO   |     | None              |                             |  
| user_id     | int(11)      | NO   |     | NULL              |                             |  
| cerated     | datetime     | NO   |     | CURRENT_TIMESTAMP |                             |  
| updated     | timestamp    | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
+-------------+--------------+------+-----+-------------------+-----------------------------+  
```

user
```
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| Field       | Type         | Null | Key | Default           | Extra                       |  
+-------------+--------------+------+-----+-------------------+-----------------------------+  
| id          | int(11)      | NO   | PRI | None              | auto_increment              |  
| nickname    | varchar(255) | NO   |     | None              |                             |  
| image       | varchar(255) | YES  |     | NULL              |                             |  
| introduction| text         | NO   |     |                   |                             |  
| birthday    | date         | NO   |     | None              |                             |  
| gender      | varchar(255) | NO   |     | None              |                             |  
| team        | varchar(255) | NO   |     | None              |                             |  
| password    | varchar(255) | NO   |     | None              |                             |   
| cerated     | datetime     | NO   |     | CURRENT_TIMESTAMP |                             |  
| updated     | timestamp    | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
+-------------+--------------+------+-----+-------------------+-----------------------------+  
```

## 使用言語
PHP 7.3.11
