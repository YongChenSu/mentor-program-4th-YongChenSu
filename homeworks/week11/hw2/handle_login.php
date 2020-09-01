<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    header('Location: ./login.php?errCode=1');
    die('INFORMATION MISSING');
  }

  $sql = "SELECT * FROM yongchen_users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  // 看是否執行成功
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  // 把結果拿回來
  $result = $stmt->get_result();
  // 查無使用者
  if ($result->num_rows === 0) {
    header('Location: ./login.php?errCode=2');
    exit();
  }

  // 有查到使用者
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    /* 1. 產生 session_id (token)
       2. 把 username 寫入專案
       3. set-cookie: seesion-id
    */
    $_SESSION['username'] = $username;
    header('Location: ./index.php');
  } else {
    header('Location: ./login.php?errCode=2');
  }
?>