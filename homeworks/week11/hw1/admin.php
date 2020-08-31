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

  if ($user === NULL || $user['role'] !== 'ADMIN') {
    header('Location: ./index.php');
    exit;
  }

  $stmt = $conn->prepare(
    "SELECT id, role, nickname, username FROM
    yongchen_users3 ORDER BY id DESC
    
  ");

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
  <title>後臺管理</title>
  <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
  <link href="./style.css" rel="stylesheet">
</head>
<body>
  <header class="warning">
    <strong>WARNING! THIS SITE IS FOR PHP PRACTICING AND UNSECURED. PLS DONT'T USE REAL-LIFE USERNAME AND PASSWORD.</strong>
  </header>
  <main class="board">
    <div class="board__title">
      <h1>ADMIN</h1>
    </div>
    <section>
      <table border>
        <tr>
          <th>id</th>
          <th>role</th>
          <th>nickname</th>
          <th>username</th>
          <th>調整身分</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo escape($row['id']) ?></td>
            <td><?php echo escape($row['role']) ?></td>
            <td><?php echo escape($row['nickname']) ?></td>
            <td><?php echo escape($row['username']) ?></td>
            <td>
              <a href="handle_update_role.php?role=ADMIN
                &id=<?php echo escape($row['id'])?>">管理員
              </a>
              <a href="handle_update_role.php?role=NORMAL
                &id=<?php echo escape($row['id'])?>">使用者
              </a>
              <a href="handle_update_role.php?role=BANNED
                &id=<?php echo escape($row['id'])?>">停權
              </a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </section>
  </main>
  <script>
  </script>
</body>
</html>