<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }

  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;

  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM yongchen_articles as A WHERE A.username = '$username' AND A.is_deleted IS NULL ORDER BY A.id DESC LIMIT ? OFFSET ?";
  } else {
    $sql = "SELECT * FROM yongchen_articles as A WHERE A.is_deleted IS NULL ORDER BY A.id DESC LIMIT ? OFFSET ?";
  }

  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $items_per_page, $offset);
  $result = $stmt->execute();

  if (!$result) {
    die('ERROR: ' . $conn->error);
  }
  $result = $stmt->get_result();
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $username . "'s BLOG" ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <link href="./style.css" rel="stylesheet">
</head>
<body>
  <?php include_once('./header.php')?>
  <main class="main__articles">
    <section class="articles">
      <form class="article__new" method="POST" action="./handle_add_article.php">
        <input class="new__title" name="title" placeholder="新文章標題">
        <textarea name="article" placeholder="新文章內容"></textarea>
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
            <input class="new__submit" type="submit" value="送出">
          </div>
        </div>
      </form>
    </section>
  <main>
</body>