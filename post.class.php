<?php

require "db.class.php"; // db.class.php dosyası varsa getir. yoksa hata ver

class Post{
    private DB $DB; // DB nesne tipiyle private DB property

    static function createPostObj(){
        $PostObj = new static(); // Post nesnesi oluşturup $PostObj 'ye ata
        $PostObj->DB = new DB(); // PostObj nesnesindeki DB property'sine, DB nesnesi oluşturup ata.
        return $PostObj; // PostObj nesnesini fonksiyonun çağrıldığı yere gönder
    }

    public function PostList(){
        try {
            $posts = $this->DB->pdo->query("SELECT * FROM posts", PDO::FETCH_OBJ); // DB nesnesi yoluyla PDO query ile posts tablosunu objeler olarak getirmek için ayarlamaları yapıp $posts'a ata.
            $posts->execute(); // $posts daki işlemi çalıştır
            return $posts->fetchAll(); // $posts ile gelen tüm verileri getirip fonksiyonun çağrıldığı yere gönder
        }catch (PDOException $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function PostInfo(int $id){
        try {
            $post = $this->DB->pdo->prepare("SELECT * FROM posts WHERE id=:id"); // DB nesnesi yoluyla PDO prepare ile posts tablosundaki istenen id değerli veriyi getirmek için ayarlamaları yapıp $post'a ata.
            $post->execute([":id" => $id]); // $post daki işlem için id değerini kullan ve çalıştır
            return $post->fetch(); // $post ile gelen veriyi fonksiyonun çağrıldığı yere gönder
        }catch (PDOException $exception) {  // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function CreatePost(string $header, string $content){
        try {
            $createPost = $this->DB->pdo->prepare("INSERT INTO posts(header,content) value(:header,:content)"); // DB nesnesi yoluyla PDO prepare ile posts tablosuna yeni veri girmek için ayarlamaları yapıp $createPost'a ata.
            return $createPost->execute([":header" => $header, ":content" => $content]); // $createPost daki işlem için header ve content değerlerini kullan ve çalıştır
        }catch (PDOException $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function EditPost(int $id, string $header, string $content){
        try {
            $editPost = $this->DB->pdo->prepare("UPDATE posts SET header=:header, content=:content WHERE id=:id"); // DB nesnesi yoluyla PDO prepare ile posts tablosundaki istenen id değerli veriyi güncellemek için ayarlamaları yapıp $editPost'a ata.
            return $editPost->execute([":id" => $id,":header" => $header, ":content" => $content]); // $editPost daki işlem için id, header ve content değerlerini kullan ve çalıştır
        }catch (PDOException $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function DeletePost(int $id){
        try {
            $deletePost = $this->DB->pdo->prepare("DELETE FROM posts WHERE id=:id"); // DB nesnesi yoluyla PDO prepare ile posts tablosundaki istenen id değerli veriyi silmek için ayarlamaları yapıp $deletePost'a ata.
            return $deletePost->execute([":id" => $id]); // $deletePost taki işlem için id değerini kullan ve çalıştır
        }catch (PDOException $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

}
