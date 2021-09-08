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
            $posts = $this->DB->CRUD(table: "posts", CrudType: "SELECT"); // DB nesnesi yoluyla posts tablosundaki tüm verileri getirmek için ayarlamaları yapıp $post'a ata.
            $posts->execute(); // $posts daki işlemi çalıştır
            return $posts->fetchAll(); // $posts ile gelen tüm verileri getirip fonksiyonun çağrıldığı yere gönder
        }catch (Exception $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function PostInfo(int $id){
        try {
            $post = $this->DB->CRUD(table:"posts",CrudType: "SELECT",where: "id=:id"); // DB nesnesi yoluyla posts tablosundaki istenen id değerli veriyi getirmek için ayarlamaları yapıp $post'a ata.
            $post->execute([":id" => $id]); // $post daki işlem için id değerini kullan ve çalıştır
            return $post->fetch(); // $post ile gelen veriyi fonksiyonun çağrıldığı yere gönder
        }catch (Exception $exception) {  // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function CreatePost(string $header, string $content){
        try {
            $createPost = $this->DB->CRUD(table: "posts",CrudType: "INSERT",insertColumns: "header,content",insertValues: ":header,:content"); // DB nesnesi yoluyla posts tablosuna yeni veri girmek için ayarlamaları yapıp $createPost'a ata.
            return $createPost->execute([":header" => $header, ":content" => $content]); // $createPost daki işlem için header ve content değerlerini kullan ve çalıştır
        }catch (Exception $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function EditPost(int $id, string $header, string $content){
        try {
            $editPost = $this->DB->CRUD(table: "posts",CrudType: "UPDATE",updateSet: "header=:header, content=:content",where: "id=:id"); // DB nesnesi yoluyla posts tablosundaki istenen id değerli veriyi güncellemek için ayarlamaları yapıp $editPost'a ata.
            return $editPost->execute([":id" => $id,":header" => $header, ":content" => $content]); // $editPost daki işlem için id, header ve content değerlerini kullan ve çalıştır
        }catch (Exception $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

    public function DeletePost(int $id){
        try {
            $deletePost = $this->DB->CRUD(table: "posts",CrudType: "DELETE",where: "id=:id"); // DB nesnesi yoluyla posts tablosundaki istenen id değerli veriyi silmek için ayarlamaları yapıp $deletePost'a ata.
            return $deletePost->execute([":id" => $id]); // $deletePost taki işlem için id değerini kullan ve çalıştır
        }catch (Exception $exception) { // PDO işlemleri hata verirse yakala ve exception değişkeniyle değer döndür
            return $exception; // Fonksiyonun çağrıldığı yere hatayı gönder
        }
    }

}