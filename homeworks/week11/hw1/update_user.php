<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $username = $_SESSION['username'];
  $nickname = $_POST['nickname'];

  if (empty($nickname)) {
    header('Location: ./index.php?errCode=1');
    die('資料不齊全');
  }

  $sql = 
    "UPDATE yongchen_users3 SET nickname = ? 
    WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $nickname, $username);
  $result = $stmt->execute();
  
  if ($result) {
    header('Location: ./index.php');
  } else {
    die('failed' . $conn->error);
  }
?>