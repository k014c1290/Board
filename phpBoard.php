<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>board</title>
</head>
<body>
  <h1>Todolist</h1>
  <form method="GET" action="./phpBoard.php">
  <table border="1"　width="500" cellspacing="0" cellpadding="5" id="table1">
  <tr>
    <td><input type="text" name="name" size="30" maxlength="20" required></td>
    <td>
      <input type="hidden" name="login" value="1">
      <input type="submit" value="login"></td>
  </tr>
</form>
  <?php
    $db = new PDO('mysql:host=localhost;dbname=Boardlist;charset=utf8', 'root', '');
    if(isset($_GET['login'])){
      $stt = $db->prepare('INSERT INTO board (user) VALUES (:user)');
      $stt->bindParam(':user', $_GET['name'], PDO::PARAM_STR);
      $stt->execute();
      //画面遷移する。
    }else if(isset($_GET['delete'])){
      $stt = $db->prepare('DELETE FROM board WHERE id = :id');
      $stt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
      $stt->execute();
    }

    $stt = $db->prepare('SELECT * FROM board');
    $stt->execute();
    while($row = $stt->fetch()){
  ?>
  <tr>
      <p><?php print($row['user']);
               print(" ");
               print($row['date']);?>
       <form method="GET" action="./phpBoard.php">
         <input type="image" src="ico_ashcan1_9.gif" name="delete" alt="削除">
         <input type="hidden" name="delete" value="1">
         <input type="hidden" name="id" value="<?php print($row['id']); ?>">
       </form>
        <?php
        print("\n");
        print($row['text']);?>
      </p>
  </tr>

<?php } ?>
</body>
</html>
