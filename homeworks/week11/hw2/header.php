<?php
  $PHPSelf = $_SERVER['PHP_SELF'];
?>
<header>
  <div class="navbar">
    <div class="block__info">
      <a href="./index.php" class="homepage">
        <?php
          if (!empty($username)){
            echo "<h2>" . $username . "'s Blog" . "</h2>";
          } else {
            echo "<h2>Blog</h2>";
          }
        ?>
      </a>
      <a href="./article_list.php">文章列表</a>
    </div>
    <div>
      <div class="block__member">
        <?php
          if (!empty($username)) {
            $role = getUserFromUsername($username)['role'];
            if ($role === 'WEBMASTER') {
              if ($PHPSelf === '/mtr04group2/YongChen/week11/hw2_blog/index.php') {
                echo '<a href="./blog_backend.php">管理後臺</a>';
              } else {
                echo '<a href="./article.php">新增文章</a>';
              }
              echo '<a href="./logout.php">登出</a>';
            } else {
                if ($PHPSelf === '/mtr04group2/YongChen/week11/hw2_blog/index.php') {
                echo '<a href="./article.php">新增文章</a>';
              } else {
                echo '<a href="./index.php">首頁</a>';
              }
              echo '<a href="./logout.php">登出</a>';
            }
          } else {
            echo '<a href="./register.php">註冊</a>';
            echo '<a href="./login.php">登入</a>';
          }
        ?>
      </div>
    </div>
  </div>
  <div class="banner">
    <h2>陽春部落格</h2>
    <p>很多做到一半的功能 ...</p>
  </div>
</header>