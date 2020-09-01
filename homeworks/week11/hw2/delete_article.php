<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $id = $_GET['id']; 
  $username = $_SESSION['username'];

  $role = getUserFromUsername($username)['role'];

  if (empty($id)) {
    header('Location: index.php?errCode=1');
    die();
  }

  if ($role === 'WEBMASTER') {
    $sql = "UPDATE yongchen_articles SET is_deleted=1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
  } else {
    $sql = "UPDATE yongchen_articles SET is_deleted=1 WHERE id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $id, $username);
  }
  
  $result = $stmt->execute();
  
  if (!$result) {
    die($conn->error);
  }

  if ($role === 'WEBMASTER') {
    header("Location: ./blog_backend.php");
  } else {
    header("Location: ./index.php");
  }
?>