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
?>