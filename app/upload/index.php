<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  $id = 0;
  if(isset($_SESSION["user_id"])) {
    $id = $_SESSION["user_id"];
  }

  require("../config.php");
  $db = connect_db();
  $content = pg_escape_string($db, $_POST["text"]);
  $quote_id = rand(1, 999);

  $sql = "INSERT INTO \"uploads\" (quote_id, user_id, content) VALUES ($quote_id, $id, '$content')";
  $res = pg_query($db, $sql);
  if ($res == TRUE) {
    header("location: /app/get/?q=$quote_id");
  } else {
    http_response_code(500);
  }
}



?>
