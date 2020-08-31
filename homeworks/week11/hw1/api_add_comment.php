<?php
  require_once('./conn.php');
  header('Content-type:application/json;charset=utf-8');

  $content = $_POST['content'];

  if (empty($content)) {
    $json = array(
      "ok" => false,
      "message" => "PLEASE INPUT CONTENT"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  $username = $_POST['username'];

  $sql = 
    "INSERT INTO yongchen_comments3(username, content)
    VALUES(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);
  $result = $stmt->execute();
  
  if (!$result) {
    $json = array(
      "ok" => false,
      "message"=>$conn->error
    );

    $response = json_encode($json);
    echo $response;
    die();
  }
  
  $json = array(
    "ok" => true,
    "message"=>"SUCCESS!"
  );

  $response = json_encode($json);
  echo $response;
?>