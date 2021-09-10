<html>
<title>Grup8-Mysql Yazı Listesi</title>
<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style type="text/css">
        body{margin: 20px;}
        .container{margin-top: 25px;}
    </style>
</header>
<body>
<div class='container col-8'>
    <?php
    //üst kısımda botstrap css framework'ünü kullanmak için gereken link işlemi yapıldı
    //post class daki methodlar kullanılmak üzere içe aktarma işlemi yapıldı
    require("post.class.php");

    try {
        $postObj= POST::createPostObj();//post classdan post objesi oluşturuldu
        $posts=$postObj->PostList();//postları almak için postlist methodu kullanıldı
    }catch (PDOException){
        die("Post objesi oluşturulurken hata oluştu.\n Lütfen post.class.php dosyasını kontrol ediliniz");
    }


    //üst kısımda yer alacak butonlar yerleştirildi
    echo "
<a href='manage.php'><button type='button' class='btn btn-outline-success'>Post List</button></button></a>
<a href='?action=create'><button type='button' class='btn btn-outline-info'>New Post</button></button></a>
";
    //$_GET ile gelen action argumanına ait içeriklere göre kıyaslama yapılarak case işlemleri ve alt işlemler yapılıyor

    if (isset($_GET["action"])){
    switch($_GET["action"]){
    case "edit":
        //edit butonu ile tıklandığında forma verileri yüklemek için tekrar sorgu yapmamak için mevcut
        //post objesinin içerisinden index numarası ile veriler okunuyor
        $arraypostid=(int) $_GET["post"];
        $id=$posts[$arraypostid]["id"];
        $header=$posts[$arraypostid]["header"];
        $content=$posts[$arraypostid]["content"];
        //$posts un içerisindeki değerler edit formunda gösterilmek üzere değişkenlere atandı
        //update işlemi için form verileri hazırlandı default veriler eklendi
        echo "<form action='manage.php?action=update' method='POST'>
    <div class='container'>
    <div class='mb-3'>
      <label class='form-label'>Header;</label>
      <input type='text' class='form-control' name='header' value='$header' required autocomplete='off'>
    </div>
    <div class='mb-3'>
      <label class='form-label'>Content;</label>
      <textarea class='form-control' name='content' rows='10' required>$content</textarea>
    </div>
    <input type='hidden' name='id' value='$id'>
    <div class='mb-3 text-end'>
    <button type='submit' class='btn btn-outline-success'>Update Post</button></div>
    </div>
    </form>";
    break;

    case "create";
    //yeni post ekleme işlemi için form verileri gösteriliyor
        echo "<form action= 'manage.php?action=store' method='POST'>
    <div class='container'>
    <div class='mb-3'>
      <label class='form-label'>Header;</label>
      <input type='text' name='header' class='form-control' required autocomplete='off'>
    </div>
    <div class='mb-3'>
      <label class='form-label'>Content;</label>
      <textarea class='form-control' name='content' rows='10' required></textarea>
    </div>
    <div class='mb-3 text-end'><button type='submit' class='btn btn-outline-success'>Creat New Post</button></div>
    </div>
    </form>";
    break;
    //DB insert, update ve delete işlemleri
    case "store";
        //action creat formundan gelen veriler post class daki methodlar ile DB'ye ekleme yapılıyor.
        $postObj->CreatePost($_POST["header"],$_POST["content"]);
        return header('Location: manage.php');
    break;
    case "delete";
        //action delete olarak gelen id numarasına göre post silme işlemi yapılıyor.
        $postid=(int) $_GET["post"];
        $postObj->DeletePost($postid);
        return header('Location: manage.php');
    break;
    case "update";
        //action edit formundan gelen veriler post class daki methodlar ile DB'de güncelleme yapılıyor.
        $postid=(int) $_POST["id"];
        $postObj->EditPost($postid,$_POST["header"],$_POST["content"]);
        return header('Location: manage.php');
    break;
        default:
            //$_GET ile aldığımız action değişkenine bu şartlar haricinde bir şey gelirse ana sayfaya yönlendir.
            return header('Location: manage.php');
    }
    }
    else{
        //action gelmeme durumunda ilk ana dosya açıldığında post listesi gösteriliyor.
        //post listesi ile ilgili form işlemleri
    ?>
    <div class='container'>
        <table class='table table-striped'>
            <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Header</th>
                <th scope='col'></th>
            </tr>
            </thead>
            <tbody>
            <tr>
 <?php
 //posts değişkenine atanan post başlıkları ve karşısında düzenleme silme butonları yerleştirilmesi
 //için foreach ile döngü oluşturup ekrana form elemanları ile yazdırıldı
 foreach ($posts as $id => $post) {
     $row = $id + 1;
     echo"<th scope='row' class='align-middle'>$row</th>
          <td  class='align-middle'>$post[header]</td>
          <td  class='align-middle' style='text-align: right'>
            <a href='?action=edit&post=$id'><button type='button' class='btn btn-outline-warning'>Edit</button></a>
            <a href='manage.php?action=delete&post=$post[id]'><button type='button' class='btn btn-outline-danger'>Delete</button></a>
          </td>
        </tr>";
                }
                echo "
      </tbody>
    </table>
</div>";
}
