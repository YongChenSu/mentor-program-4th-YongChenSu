<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $title = $_POST['title'];
  $article = $_POST['article'];

  if (empty($article) || empty($title)) {
    header('Location: ./index.php?errCode=1');
    die('INFORMATION MISSING');
  }

  $username = $_SESSION['username'];

  $sql = "INSERT INTO yongchen_articles(username, title, article) VALUES(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $username, $title, $article);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error);
  } else {
    header("Location: ./index.php?");
  }
?>