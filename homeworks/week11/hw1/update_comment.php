<?php
  session_start(); 
  require_once('./conn.php');
  require_once('./utils.php');
  
  $id = $_GET['id'];

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $stmt = $conn->prepare(
    "SELECT * FROM yongchen_comments3
    WHERE id =? ");
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOARD 3</title>
  <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
  <link href="./style.css" rel="stylesheet">
</head>
<body>
  <header class="warning">
    <strong>WARNING! THIS SITE IS FOR PHP PRACTICING AND UNSECURED. PLS DONT'T USE REAL-LIFE USERNAME AND PASSWORD.</strong>
  </header>
  <main class="board">
    <div class="board__title">
      <h1>SAY SOMETHING ...</h1>
      <?php 
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $msg = 'Error';
          if ($code === '1') {
            $msg = 'INFORMATION MISSING';
          }
          echo '<h2 class="error">ERROR：' . $msg . '</h2>';
        }
      ?>
      <form class="board__comment-form" method="POST" action="./handle_update_comment.php">
        <textarea name="content" placeholder="PLEASE ENTER A MESSAGE" required><?php echo $row['content'] ?></textarea>
        <input class="hidden" name="id" value="<?php echo $row['id']?>" />
        <input class="board__submit-btn" type="submit" value="SEND" />
      </form>
  </div>
  </main>
</body>
</html>