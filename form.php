<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
</head>
<body>
<form action="/form.php" method="POST">
    <input type="search" name="search">
    <input type="submit" value="Найти">
</form>
<?php
if(isset($_POST['search']) &&  strlen($_POST['search']) > 3) {
    $con = pg_connect("host=localhost port=5432 dbname=inline user=postgres password=290861");
    $result = pg_exec($con,"SELECT * FROM posts Where id in (SELECT postid from comments where body LIKE '%".$_POST['search']."%')");
    if($result) {
        for($row = 0; $row < pg_numrows($result); $row++) {
          echo "Запись №" .pg_result($result,$row,'id') . " title:" . pg_result($result,$row,'title')." <br>"
          ."text:". pg_result($result,$row,'body')."<br> <br>";
        }
    }
    else {
        echo "Записей нет <br>";
    }

    echo $_POST['search'];
}
else {
    echo "В строке нет символов или меньше 3";
}
?>
</body>
</html>
