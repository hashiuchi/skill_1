<?php

$dsn = 'mysql:dbname=skill_1;host=localhost';
$user = 'root';
$password='';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');



$sql='SELECT * FROM `tasks` ORDER BY date ASC';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$alls = array();

while (1)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($rec==false)
  {
    break;
  }
  $alls[]=$rec;
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
<body style="margin-top: 70px">

  <div class="container">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1">

        <h2 class="text-center content_header">タスク管理</h2>

        <div class="col-xs-4">
          <a href="post.php" class="btn btn-primary button">追加</a>
        </div>
        <div class="col-xs-8">
          <?php foreach ($alls as $all): ?>
          <article class="timeline-entry">
           <div class="task" >
            <h3><?php echo $all['title']?></h3>
             <div class="content">
              <h3 style="font-weight: bold;"><?php echo $all['date']?></h3>
              <h4><?php echo $all['detail']?></h4>
              <!-- 削除ボタン -->
              <a href="delete_1.php?id=<?php echo $all["id"]; ?>" class="btn btn-danger">削除</a>

              <a href="edit_1.php?id=<?php echo $all["id"]; ?>" class="btn btn-success">編集</a>
             </div>
           </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>