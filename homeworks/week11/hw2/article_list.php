<?php
  session_start();
  require_once('./conn.php');
  require_once('./utils.php');

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }

  $items_per_page = 15;
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
  // $result = $conn->query($sql);
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
  <title><?php echo "BLOG" ?></title>
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <link href="./style.css" rel="stylesheet">
</head>
<body>
  <?php include_once('./header.php') ?>
  <main class="main__articles">
    <section class="articles">
      <?php while($row = $result->fetch_assoc()) { ?>
        <div class="list__block">
          <div class="title"><?php echo escape($row['title']) ?></div>
          <div>
            <div class="time">
              <div class="time__detail"><?php echo escape($row['created_at']) ?></div>
            </div>
            <div>
              <?php if(!empty($username)) { ?>
                <a class="delete" href="./delete_article.php?id=<?php echo $row['id']?>">刪除</a>
                <a class="edit" href="./update_article.php?id=<?php echo $row['id']?>">編輯</a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </section>

    <?php if (!empty($username)) {
      $sql = "SELECT count(id) as count FROM yongchen_articles as A
        WHERE A.username = '$username' AND A.is_deleted IS NULL";
    } else {
      $sql = "SELECT count(id) as count FROM yongchen_articles as A
        WHERE A.is_deleted IS NULL";
    }
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page);
    ?>
    <section class="paginator">
      <div class="pre__most">
        <a class="page__first" href="./article_list.php?page=1">FIRST PAGE</a>
        <a class="page__pre" href="./article_list.php?page=<?php echo $page - 1 < 1 ? (1) : ($page - 1) ?>">PRE</a>
      </div>
      <div class="page__total">
        <div>TOTAL: <?php echo $count?></div>
        <div><?php echo $page . '/' . $total_page?></div>
      </div>
      <div class="next__most">
        <a class="page__next" href="./article_list.php?page=<?php echo $page + 1 > $total_page ? ($total_page) : ($page + 1) ?>">NEXT</a>
        <a class="page__last" href="./article_list.php?page=<?php echo $total_page ?>">LAST PAGE</a>
      </div>
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