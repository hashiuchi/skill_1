<?php
$dsn = 'mysql:dbname=skill_1;host=localhost';
$user = 'root';
$password='';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');


if (!empty($_POST)) {
  $mustdo = htmlspecialchars($_POST['mustdo']);
  $date = htmlspecialchars($_POST['date']);
  $detail = htmlspecialchars($_POST['detail']);

  if (!empty($mustdo || $date || $detail)) {
    $sql='INSERT INTO `tasks`(`title`,`date`,`detail`) VALUES(?,?,?)';
    $data =[$mustdo,$date,$detail];
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);

    header("location: schedule.php");
  }
}

$dbh=null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Skill Test</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px">
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-xs-offset-2 thumbnail">
        <h2 class="text-center content_header">タスク追加</h2>

        <form method="POST" action="">
          <div class="form-group">
            <label for="task">タスク</label>
            <input type = "text" name="mustdo" class="form-control">
          </div>
          <div class="form-group">
            <label for="date">日程</label>
            <input type="date" name="date" class="form-control">
          </div>
          <div class="form-group">
            <label for="detail">詳細</label>
            <textarea name="detail" class="form-control" rows="3"></textarea><br>
          </div>
          <input type="submit" class="btn btn-primary" value="投稿">
        </form>

      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>