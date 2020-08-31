<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOARD 3</title>
  <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <header class="warning">
    <strong>WARNING! THIS SITE IS FOR PHP PRACTICING AND UNSECURED. PLS DONT'T USE REAL-LIFE USERNAME AND PASSWORD.</strong>
  </header>
  <main class="board board__login">
    <div class="board__member">
      <a class="board__member-btn" href="./index.php">BACK TO BOARD</a>
      <a class="board__member-btn" href="./login.php">LOGIN</a>
    </div>
    <div class="board__login-container">
      <h1>REGISTER</h1>
      <?php
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $msg = 'Error';
          if ($code === '1') {
            $msg = 'INFORMATION MISSING';
          } else if ($code === '2') {
            $msg = 'REGISTERED ACCOUNT';
          }
          echo '<h2 class="error">ERROR:' . $msg . '</h2>';
        }
      ?>
      
      <form class="board__comment-form" method="POST" action="./handle_register.php">
        <div class="board__input">
          <span>NICKNAME</span>
          <input type="text" name="nickname" />
        </div>
        <div class="board__input">
          <span>USERNAME</span>
          <input type="text" name="username" />
        </div>
        <div class="board__input">
          <span>PASSWORD</span>
          <input type="password" name="password" />
        </div>
        <div>
          <input class="board__submit-btn" type="submit" value="SEND" />
        </div>
      </form>
    </div>
  </main>
</body>
</html>