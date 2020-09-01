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
  $sql = "SELECT * FROM yongchen_users3 WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  $result= $stmt->get_result();
  if ($result->num_rows === 0) {
    header('Location: ./login.php?errCode=2');
    exit();
  }

  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    // if ($result->num_rows) {
    $_SESSION['username'] = $username;
    header('Location: ./index.php');
  } else {
    header('Location: ./login.php?errCode=2');
  }
?>