<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Post</title>
</head>
<body>
    <div class="container">
        <?php

        require 'post.class.php';   //Gerekli Sınıf Dahil Et

        $db =  Post::createPostObj();   //Öncelikle Db objesi oluşturulur
        $posts = $db->PostList();   //Post Listesi Getirilir
            if(isset($_GET["post"])){   //Eğer get ile bir değişken geldiyse
                $post_id = $_GET["post"];   //bu değeri değişkene ata
                if($db->PostInfo($post_id)){    //eğer veritabanında bu idye sahip post varsa getir
                    $post = $db->PostInfo($post_id);    //GElen postu değişkene ata ve ekrana bas
                echo '  <div class="card border-dark mt-5">
                            <div class="card-header"><h5>'.$post["header"].'</h5></div> 
                            <div class="card-body text-dark">
                                <p class="card-text">'.$post["content"].'</p>
                            </div>
                        </div>';
                echo '<div class="d-flex justify-content-end mt-3"><a href="index.php" class="btn btn-danger">Anasayfa</a></div>';
                }
                else{   //Post yoksa böyle bir post bulunamadı sayfasına gönder
                    echo '<div class="text-center"><h3 class="mt-5">Böyle bir post bulunamadı.</h3></br>
                            <a href="index.php" class="btn btn-danger">Anasayfaya Dön</a>
                         </div>';
                }
            }else{  //post işlemi yoksa
                echo '<div class="text-center mt-5">
                        <h1>Post Listesi</h1>
                    </div>';
                foreach($posts as $post){    //veritabanından gelen tüm postları listele
                    echo '<div class="card mt-5">
                            <div class="card-header">
                                <h4>What is Lorem Ipsum?'.$post["header"].'</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-truncate">'.$post["content"].'</p>
                                <div class="d-flex justify-content-end">
                                    <a href="index.php?post='.$post["id"].'" class="btn btn-primary">Devamını Oku</a>
                                </div>
                            </div>
                        </div>';
                }
            }
        ?>
    </div>
</body>
</html>