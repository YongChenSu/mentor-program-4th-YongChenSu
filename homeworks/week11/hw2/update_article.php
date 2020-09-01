<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $id = $_GET['id'];
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $role = getUserFromUsername($username)['role'];

  if ($role === 'WEBMASTER') {
    $sql = "SELECT * FROM yongchen_articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
  } else {
    $sql = "SELECT * FROM yongchen_articles WHERE id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id, $username);
  }
  

  $result = $stmt->execute();
  if (!$result) {
    die('ERROR: ' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $username . "'s BLOG" ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <link href="./style.css" rel="stylesheet">
</head>
<body>
  <?php include_once('./header.php'); ?>
  <main class="main__articles">
    <div class="articles">
      <?php if(!empty($_SESSION['username'])) { ?>
        <form class="article__new" method="POST" action="./handle_update_article.php">
          <input class="new__title" name="title" value="<?php echo $row['title'] ?>">
          <textarea name="article" placeholder="新文章內容"><?php echo $row['article'] ?></textarea>
          <div class="new__submit-container">
            <?php if (!empty($_GET['errCode'])) {
                $msg = 'ERROR';
                $errCode = $_GET['errCode'];
                if ($errCode == 1) {
                  $msg = 'PLEASE INPUT TITLE AND CONTENT';
                }
                echo '<h3 class="error">' . $msg . '</h3>';
              } else {
                echo '<div></div>'; //  for justify-content: space-between
              }
            ?>
            <div>
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <input class="new__submit" type="submit" value="送出">
            </div>
          </div>
        </form>
      <?php } ?>
    </div>
  <main>
</body>
</html>