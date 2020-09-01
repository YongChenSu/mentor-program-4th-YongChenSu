<?php
  session_start(); 
  require_once('./conn.php');
  require_once('./utils.php');
  
  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $item_per_page = 5; //limit
  $offset = ($page - 1)*$item_per_page;

  $sql = "SELECT 
    C.id as id, C.content as content, 
    C.created_at as created_at, U.nickname as nickname, U.username as username
    FROM yongchen_comments3 as C 
    LEFT JOIN yongchen_users3 as U
    ON C.username = U.username
    WHERE C.is_deleted IS NULL
    ORDER BY C.id DESC
    LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $item_per_page, $offset);
  $result = $stmt->execute();
    
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
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
      <?php if (!empty($username)) { ?>
        <h3>HELLO, <?php echo $user['nickname'] ?></h3>
        <button class="nickname-btn">EDIT</button>
      <?php } else { ?>
        <h3>HELLO</h3>
      <?php } ?>
      <?php if ($user && $user['role'] === 'ADMIN') { ?>
        <a class="board__member-btn" href="./admin.php">管理後臺</a>
      <?php } ?>
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
      <form class="hide board__nickname-form" method="POST" action="./update_user.php">
        <strong>NEW NICKNAME:</strong>
        <input class="board__nickname-input" type="text" name="nickname">
        <input class="board__submit-btn" type="submit" value="SEND">
      </form>
      <form class="board__comment-form" method="POST" action="./handle_add_comment.php">
        <textarea name="content" placeholder="PLEASE ENTER A MESSAGE"></textarea>
        <?php if ($username && !hasPermission($user, 'create', NULL)) { ?>
          <h3>YOU ARE BANNED.</h3>
        <?php } else if ($username) { ?>
          <input class="board__submit-btn" type="submit" value="SEND">
        <?php } else { ?>
          <h3>PLEASE LOGIN AND LEAVE YOUR MESSAGE</h3>
        <?php } ?>
        </form>
    </div>
    <section>
      <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card">
          <div class="card__avatar__container">
            <div class="card__avatar"></div>
          </div>
          <div class="card__body">
            <div class="card__info">
              <span class="card__author">
                <?php echo escape($row['nickname']); ?>
                (@<?php echo escape($row['username']); ?>)
              </span>
              <span class="card__time"><?php echo escape($row['created_at']) ?></span>
              <?php if (!empty($username)) { ?>
                <?php if (hasPermission($user, 'update', $row)) { ?>
                  <div class="btn-container">
                    <a class="edit__comment-btn" href="./update_comment.php?id=<?php echo $row['id']?>">EDIT</a>
                    <a class="delete__comment-btn" href="./delete_comment.php?id=<?php echo $row['id']?>">DELETE</a>
                  </div>
                <?php } ?>
              <?php } ?>
              </div>
              <div class="card__content"><?php echo escape($row['content']) ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </section>
    <?php
      $stmt = $conn->prepare(
        "SELECT count(id) as count FROM yongchen_comments3
        WHERE is_deleted IS NULL
      ");
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $item_per_page);
    ?>
    <div class="page-info">
      <div>TOTAL: <?php echo $count?></div>
      <div><?php echo $page . '/' . $total_page?></div>
    </div>
    <div class="page-info">
      <a href="index.php?page=1">HOME PAGE</a>
      <a href="index.php?page=<?php echo $page - 1 < 1 ? (1) : ($page - 1) ?>">PREV</a>
      <a href="index.php?page=<?php echo $page + 1 > $total_page ? ($total_page):($page + 1) ?>">NEXT</a>
      <a href="index.php?page=<?php echo $total_page?>">LAST PAGE</a>
    </div>
  </main>
  <script>
    const nicknameBtn = document.querySelector('.nickname-btn')
    const nicknameEditToggle = document.querySelector('.board__nickname-form')
    nicknameBtn.addEventListener('click', () => {
      nicknameEditToggle.classList.toggle('hide')
    })
  </script>
</body>
</html>