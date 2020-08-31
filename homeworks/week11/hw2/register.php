<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REGISTER</title>
  <link href="./style.css" rel="stylesheet">
</head>
<body>
  <?php include_once("./header.php")?>
  <main class="main__login">
    <div class="login__container">
      <div class="login">
        <h1 class="title">REGISTER</h3>
        <form method="POST" action="handle_register.php">
          <h4>NICKNAME</h4>
          <input class="input" name="nickname">
          <h4>USERNAME</h4>
          <input class="input" name="username">
          <h4>PASSWORD</h4>
          <input class="input" name="password" type="password">
          <?php if (!empty($_GET['errCode'])) {
            $errCode = $_GET['errCode'];
            $msg = 'ERROR';
            if ($errCode === '1') {
              $msg = 'INFORMATION MISSING';
            } else if ($errCode === '2') {
              $msg = 'USERNAME IS REGISTERED';
            }
              echo '<h4 class="error">' . $msg . '</h4>';
            } else {
              echo '<h4 class="invisibility">JOIN</h4>';
            }
          ?>
          <input class="submit" type="submit" value="JOIN">
        </form>
      </div>
    </div>
  </main>
</body>
</html>