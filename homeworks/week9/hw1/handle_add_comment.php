<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $content = $_POST['content'];

  if (empty($content)) {
    header('Location: ./index.php?errCode=1');
    die('資料不齊全');
  }

  $user = getUserFromUsername($_SESSION['username']);
  $nickname = $user['nickname'];

  $sql = sprintf(
    "INSERT INTO yongchen_comments3(nickname, content)
    VALUES('%s', '%s')",
    $nickname,
    $content
  );

  $result = $conn->query($sql);
  
  if ($result) {
    header('Location: ./index.php');
  } else {
    die('failed' . $conn->error);
  }
?>