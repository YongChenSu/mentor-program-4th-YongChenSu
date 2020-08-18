<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  // 檢查資料是否齊全
  if (empty($username) || empty($password)) {
    header('Location: ./login.php?errCode=1');
    die('');
  }

  // 查資料庫並取出資料
  $sql = sprintf("SELECT * FROM yongchen_users3
    WHERE username = '%s' and password = '%s'",
    $username,
    $password 
  );

  $result = $conn->query($sql);

  if (!$result) {
    die($conn->error);
  }

  if ($result->num_rows) {
    $_SESSION['username'] = $username;
    header('Location: ./index.php');
  } else {
    header('Location: ./login.php?errCode=2');
  }
?>