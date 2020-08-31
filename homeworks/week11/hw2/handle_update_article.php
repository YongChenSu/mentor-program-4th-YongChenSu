<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $username = $_SESSION['username'];
  $role = getUserFromUsername($username)['role'];
  $id = $_POST['id'];
  $title = $_POST['title'];
  $article = $_POST['article'];

  if (empty($article)) {
    header('Location: ./update_article.php?errCode=1&id=' . $_POST['id']);
    die('IMFORMATION MISSING');
  }

  if ($role === 'WEBMASTER') {
    $sql = "UPDATE yongchen_articles SET title = ?, article = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $title, $article, $id);
  } else {
    $sql = "UPDATE yongchen_articles SET title = ?, article = ? WHERE id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssis', $title, $article, $id, $username);
  }
  
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  }

  header("Location: ./index.php");
?>