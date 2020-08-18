<?php
  // 與資料庫連線
  require_once('./conn.php');

  // 將使用者輸入的資料存成變數
  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // 判斷使用者是否都有確實輸入資料
  if (empty($nickname) || empty($username) || empty($password)) {
    header('Location: ./register.php?errCode=1');
    die('資料不齊全');
  }

  // sql 方法：將使用者輸入的資料存到資料庫的特定欄位中
  $sql = sprintf("INSERT INTO yongchen_users3(nickname, username, password)
    VALUES('%s', '%s', '%s')",
    $nickname,
    $username,
    $password
  );

  // 查詢資料庫，使用 sql 方法，取得結果
  $result = $conn->query($sql);
  
  // 判斷結果如何並導引到對應的頁面
  if ($result) {
    header('Location: ./index.php');
  } else {
    // 因在資料庫有限制帳號不可重複
    // 故利用錯誤訊息於頁面上顯示提示
    // 若要驗證的文字符合，重複帳號的錯誤訊息的部分文字
    if (strpos($conn->error, "Duplicate entry") !== false)   {
      header('Location: ./register.php?errCode=2');
      die($conn->error);
    }
  }
?>