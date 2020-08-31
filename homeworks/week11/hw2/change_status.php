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

  $PHPSelf = $_SERVER['PHP_SELF'];

  $username = NULL;

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM yongchen_articles as A WHERE A.username = '$username' AND A.is_deleted IS NULL ORDER BY A.id DESC LIMIT ? OFFSET ?";
  } else {
    $username = 'YongChen';
    $sql = "SELECT * FROM yongchen_articles as A WHERE A.username = '$username' AND A.is_deleted IS NULL ORDER BY A.id DESC LIMIT ? OFFSET ?";
  }

  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $items_per_page, $offset);
  $result = $stmt->execute();

  if (!$result) {
    die('ERROR: ' . $conn->error);
  }
  $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo $username . "'s BLOG" ?>
  </title>
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <link href="./style.css" rel="stylesheet">
</head>
<body>
  <?php include_once('./header.php')?>
  <main class="main__articles">
    <section class="articles">
      <div>回到 YongChen's Blog
        <form action="./index.php"></form>
      </div>
      <div>以新身分註冊並登入</div>
      <div>以網站管理者身分登入</div>
    </section>

  <main>
</body>
<script>
  const paginator = document.querySelector('.paginator')
  paginator.addEventListener('click', (e) => {
    if (e.target.classList.contains('page__first') || 
      e.target.classList.contains('page__pre')) {
      if (<?php echo $page ?> === 1) {
        e.preventDefault()
      }
    } else if (e.target.classList.contains('page__next') || 
      e.target.classList.contains('page__last')) {
      if (<?php echo $page?> === <?php echo $total_page ?>) {
        e.preventDefault()
      }
    }
  })
</script>
</html>