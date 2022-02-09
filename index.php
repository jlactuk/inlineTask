<?php
     $urlPosts = "https://jsonplaceholder.typicode.com/posts";
     $urlComments = "https://jsonplaceholder.typicode.com/comments";
        $readJSONFile = file_get_contents($urlComments);
        $arrayComments = json_decode($readJSONFile, TRUE);
        $readJSONFile = file_get_contents($urlPosts);
        $arrayPosts = json_decode($readJSONFile, true);
        if(isset($_POST['insert'])) {
            $_POST['insert'] = false;
            $con = pg_connect("host=localhost port=5432 dbname=inline user=postgres password=290861");
        foreach ( $arrayPosts as $post) {

            $sql = "Insert into posts(userid,title,body) VALUES (".$post['userId'].",'".$post['title']."','".$post['body']."')";
            $result = pg_query($con,$sql);
        }
        foreach ( $arrayComments as $comment) {
            $sql = "Insert into comments(postid,name,email,body) VALUES (".$comment['postId'].",'".$comment['name']."','".$comment['email']."','".$comment['body']."')";
            $result = pg_query($con,$sql);
        }
            echo "Загружено ".count($arrayPosts)." записей и ".count($arrayComments)." комментариев";
        }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/" method="post">
    <input type="hidden" name="insert" value="true">
    <button >Записать данные</button>
</form>
<a href="form.php">Поиск</a>
</body>
</html>
