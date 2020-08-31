<?php
  require_once('./conn.php');
  
  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf(
      "SELECT * FROM yongchen_users3 WHERE username = '%s'",
      $username
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  // $action: update, delete, create
  function hasPermission($user, $action, $comment) {
    if ($user['role'] === NULL) {
      return ($action !== 'create');
    }

    if ($user['role'] === 'ADMIN') {
      return true;
    }

    if ($user['role'] === 'NORMAL') {
      if ($action === 'create') return true;
      return ($comment['username'] === $user['username']);
    }

    if ($user['role'] === 'BANNED') {
      return ($action !== 'create');
    }
  }

  function isAdmin($user) {
    return $user['role'] === 'ADMIN';
  }
?>