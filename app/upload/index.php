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
  while (true) {
    $quote_id = rand(1, 9468);
    $sql = "SELECT quote_id FROM uploads WHERE quote_id = $quote_id";
    $res = pg_query($db, $sql);
    if (pg_num_rows($res) == 0) {
      break;
    }
  }

  $sql = "INSERT INTO \"uploads\" (quote_id, user_id, content) VALUES ($quote_id, $id, '$content')";
  $res = pg_query($db, $sql);
  if ($res == TRUE) {
    require("../get/search.php");
    $quote = get_line($quote_id);
    header("location: /g/$quote");
  } else {
    http_response_code(500);
  }
}



?>
