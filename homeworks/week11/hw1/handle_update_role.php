<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $id = $_GET['id'];
  $role = $_GET['role'];
  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

  if (empty($id) || empty($role)) {
    // header('Location: ./update_comment.php?errCode=1&id='.$POST['id']);
    die('資料不齊全');
  }

  if (!$user || $user['role'] !== 'ADMIN') {
    header('Location: ./admin.php');
    exit;
  }

  $sql = "UPDATE yongchen_users3 SET role = ? 
    WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $role, $id);

  $result = $stmt->execute();
  
  if ($result) {
    header('Location: ./admin.php');
  } else {
    die('failed' . $conn->error);
  }
?>