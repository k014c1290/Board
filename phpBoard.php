<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>board</title>
</head>
<body>
  <a style='float:right;' href='./login.html'>ログアウト</a>
  <h1>掲示板</h1>
  <form method='POST' action='./phpBoard.php'>
    <p><?php print($_POST['user']."さん"); ?></p>
    <input type='text' name='name'>
    <input type='submit' value='add'>
    <input type='hidden' name='add' value='1'>
    <input type='hidden' name='user' value='<?php print($_POST['user']); ?>'>
  </form>
  <hr>
  <?php
    $db = new PDO('mysql:host=localhost;dbname=Boardlist;charset=utf8', 'root', '');
    if(isset($_POST['add'])){
      $stt = $db->prepare("INSERT INTO board (user, date, name) VALUES (:user, STR_TO_DATE(:date, '%Y/%m/%d'), :name)");
      $now = date('Y/m/d');
      $stt->bindParam(':user', $_POST['user'], PDO::PARAM_STR);
      $stt->bindParam(':date', $now, PDO::PARAM_STR);
      $stt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
      $stt->execute();
    }else if(isset($_POST['delete'])){
      $stt = $db->prepare('DELETE FROM board WHERE id = :id');
      $stt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
      $stt->execute();
    }

    $stt = $db->prepare('SELECT * FROM board');
    $stt->execute();
    while($row = $stt->fetch()){
  ?>
  <tr>
    <p>
      <form method="POST" action="./phpBoard.php">
        <?php print($row['user']." ".$row['date']); ?>
        <input type="image" src="ico_ashcan1_9.gif" name="delete" alt="削除">
        <input type="hidden" name="delete" value="1">
        <input type="hidden" name="id" value="<?php print($row['id']); ?>">
        <input type='hidden' name='user' value='<?php print($_POST['user']); ?>'>
        <p><?php print($row['name']); ?></p>
      </form>
    </p>
    <hr>
  </tr>
<?php } ?>
</body>
</html>
