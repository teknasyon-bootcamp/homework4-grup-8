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
        $posts = [
            [
                'id' => 1,
                'header' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which ',
                'content' => 'Some quick example text to build on the card title and make up the bulk of the card content.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which '
            ],            [
                'id' => 3,
                'header' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which ',
                'content' => 'Some quick example text to build on the card title and make up the bulk of the card content.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which '
            ],            [
                'id' => 5,
                'header' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which ',
                'content' => 'Some quick example text to build on the card title and make up the bulk of the card content.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which '
            ],            [
                'id' => 7,
                'header' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which ',
                'content' => 'Some quick example text to build on the card title and make up the bulk of the card content.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which '
            ],
        ];
            if(isset($_GET["post"])){
                $post_id = $_GET["post"];
                if($post_id == $posts[0]["id"]){
                    $post = $posts[0];
                echo '  <div class="card border-dark mt-5">
                            <div class="card-header"><h5>'.$post["header"].' '.$post_id.'</h5></div>
                            <div class="card-body text-dark">
                                <p class="card-text">'.$post["content"].'</p>
                            </div>
                        </div>';
                echo '<div class="d-flex justify-content-end mt-3"><a href="index.php" class="btn btn-danger">Anasayfa</a></div>';
                }
                else{
                    echo '<div class="text-center"><h3 class="mt-5">Böyle bir post bulunamadı.</h3></br>
                            <a href="index.php" class="btn btn-danger">Anasayfaya Dön</a>
                         </div>';
                }
            }else{
                echo '<div class="text-center mt-5">
                        <h1>Post Listesi</h1>
                    </div>';
                foreach($posts as $post){    
                    echo '<div class="card mt-5">
                            <div class="card-header">
                                <h4>What is Lorem Ipsum?'.$post["header"].' '.$post["id"].'</h4>
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