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
    require("post.class.php");

    $postObj= POST::createPostObj();
    $posts=$postObj->PostList();

    echo "
<a href='manage.php'><button type='button' class='btn btn-outline-success'>Post List</button></button></a>
<a href='?action=create'><button type='button' class='btn btn-outline-info'>New Post</button></button></a>
";

    if (isset($_GET["action"]) && $_GET["action"]=="edit"){
        $arraypostid=(int) $_GET["post"];
        $id=$posts[$arraypostid]["id"];
        $header=$posts[$arraypostid]["header"];
        $content=$posts[$arraypostid]["content"];
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
    }
    if (isset($_GET["action"]) && $_GET["action"]=="create") {
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
    }
    if (isset($_GET["action"]) && $_GET["action"]=="store") {
        $postObj->CreatePost($_POST["header"],$_POST["content"]);
        return header('Location: manage.php');
    }
    if (isset($_GET["action"]) && $_GET["action"]=="delete") {
        $postid=(int) $_GET["post"];
        $postObj->DeletePost($postid);
        return header('Location: manage.php');
    }
    if (isset($_GET["action"]) && $_GET["action"]=="update") {
        $postid=(int) $_POST["id"];
        $postObj->EditPost($postid,$_POST["header"],$_POST["content"]);
        return header('Location: manage.php');
    }
    if(!isset($_GET["action"])){
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