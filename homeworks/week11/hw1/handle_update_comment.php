<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $id = $_POST['id'];
  $content = $_POST['content'];
  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

  if (empty($content)) {
    header('Location: ./update_comment.php?errCode=1&id='.$POST['id']);
    die('資料不齊全');
  }



  $sql = "UPDATE yongchen_comments3 SET content = ? 
    WHERE id = ? AND username = ?";

  if (isAdmin($user)) {
    $sql = "UPDATE yongchen_comments3 SET content = ? 
    WHERE id = ?";
  }
  
  $stmt = $conn->prepare($sql);
  if (isAdmin($user)) {
    $stmt->bind_param('si', $content, $id);
  } else {
    $stmt->bind_param('sis', $content, $id, $username);
  }
  $result = $stmt->execute();
  
  if ($result) {
    header('Location: ./index.php');
  } else {
    die('failed' . $conn->error);
  }
?>