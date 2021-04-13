<?php
session_start();
if(!isset($_SESSION["admin"])) {
  http_response_code("403");
  header("location: /app/admin/");
  die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  require("../config.php");
  $db = connect_db();
  $id = pg_escape_string($db, $_GET["id"]);
  $sql = "DELETE FROM \"user\" WHERE id = $id";
  $res = pg_query($db, $sql);
  if ($res == true) {
    header("location: /app/admin/");
  } else {
    echo "Error";
  }
} else {
  header("location: /app/admin/");
}
?>
