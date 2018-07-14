<?php

  $dsn = 'mysql:dbname=skill_1;host=localhost';
$user = 'root';
$password='';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

//SQL文を実行する
if (!empty($_POST)) {
  $mustdo = htmlspecialchars($_POST['mustdo']);
  $date = htmlspecialchars($_POST['date']);
  $detail = htmlspecialchars($_POST['detail']);

  if (!empty($mustdo || $date || $detail)) {
    $sql='INSERT INTO `tasks`(`title`,`date`,`detail`) VALUES(?,?,?)';
    $data =[$mustdo,$date,$detail];
    $stmt=$dbh->prepare($sql);
    $stmt->execute($data);
  }
}

$sql='SELECT * FROM `tasks`';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$comments = array();

while (1)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($rec==false)
  {
    break;
  }
  $comments[]=$rec;
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
<body style="margin-top: 40px">

  <div class="container">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1">

        <h2 class="text-center content_header">タスク管理</h2>

        <div class="col-xs-4">
          <a href="http://localhost/batch43/skill_1/post.php" class="btn btn-primary button">追加</a>
        </div>
        <br><br>
        <br><br>
        <br><br>

        <?php foreach ($comments as $comment): ?>
        <article class="timeline-entry">
        <div class="col-xs-8">
          <div class="task" >
            <h3><?php echo $comment['title']?></h3>
            <div class="content">
              <h3 style="font-weight: bold;"><?php echo $comment['date']?></h3>
              <h4><?php echo $comment['detail']?></h4>
            </div>
          </div>
          </div>
          </article>
          <?php endforeach; ?>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>