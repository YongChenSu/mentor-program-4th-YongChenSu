<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $content = $_POST['content'];

  if (empty($content)) {
    header('Location: ./index.php?errCode=1');
    die('資料不齊全');
  }

  // $user = getUserFromUsername($_SESSION['username']);
  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

  if (!hasPermission($user, 'create', NULL)) {
    header('Location: ./index.php');
    exit();
  }

  $sql = 
    "INSERT INTO yongchen_comments3(username, content)
    VALUES(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);
  $result = $stmt->execute();
  
  if ($result) {
    header('Location: ./index.php');
  } else {
    die('failed' . $conn->error);
  }
?>