<?php
  session_start(); 
  require_once('./conn.php');
  require_once('./utils.php');
  $username = NULL;

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $sql = "SELECT * FROM yongchen_comments3 ORDER BY id DESC";
  $result = $conn->query($sql);
  if (!$result) {
    die('Error:' . $conn->error);
  }
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
    <div class="board__member">
      <?php if (!$username) { ?> 
        <a class="board__member-btn" href="./register.php">REGISTER</a>
        <a class="board__member-btn" href="./login.php">LOGIN</a>
      <?php } else { ?>
        <a class="board__member-btn" href="./logout.php">Logout</a>
      <?php } ?>
    </div>
    <div class="board__title">
      <h1>SAY SOMETHING ...</h1>
      <h3>Hello, <?php echo $username ?></h3>
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
      <form class="board__comment-form" method="POST" action="./handle_add_comment.php">
        <textarea name="content" placeholder="PLEASE ENTER A MESSAGE" required></textarea>
        <?php if ($username) { ?>
          <input class="board__submit-btn" type="submit" value="SEND"">
        <?php } else { ?>
          <h3>PLEASE LOGIN AND LEAVE YOUR MESSAGE</h3>
        <?php } ?>
        </form>
    </div>
    <section>
      <!-- 從資料庫中拿取資料 -->
      <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card">
          <div class="card__avatar__container">
            <div class="card__avatar"></div>
          </div>
          <div class="card__body">
            <div class="card__info">
              <span class="card__author"><?php echo $row['nickname'] ?></span>
              <span class="card__time"><?php echo $row['created_at'] ?></span>
            </div>
            <div class="card__content"><?php echo $row['content'] ?></div>
          </div>
        </div>
      <?php } ?>
    </section>
  </main>
</body>
</html>