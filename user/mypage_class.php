<?php
class Mypage {

    private $user;
    private $post;

    // function __construct($pdo, $id){
    //     $this->user = $this->findUser($pdo, $id);
    //     $this->post = $this->findPbooks($pdo, $id);
    // }     

    public function user($user){
        $this->user = $user;
    }
    
    public function findUser($pdo, $id){
        $sql = 'SELECT user.id, nickname, image, introduction, birthday, 
        gender, user.team, email, picture.id, sp_name, picture, 
        description, picture.team, user_id
        FROM user LEFT JOIN picture 
        ON user.id = picture.user_id WHERE user.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findPbooks($pdo, $id){
        $sql = 'SELECT picture.id, sp_name, picture, 
        description, picture.team, user_id
        FROM user LEFT JOIN picture 
        ON user.id = picture.user_id WHERE user.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}