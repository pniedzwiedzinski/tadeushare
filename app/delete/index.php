<?php
session_start();
if(!isset($_SESSION["user_id"]) || !isset($_GET["q"])) {
  http_response_code(403);
  header("location: /app/");
  die();
}

require("../config.php");
$db = connect_db();
$id = pg_escape_string($db, $_GET["q"]);
$sql = "SELECT user_id FROM uploads WHERE quote_id = $id";
$res = pg_query($db, $sql);
$row = pg_fetch_assoc($res);
if ($row["user_id"] == $_SESSION["user_id"]) {
  $sql = "DELETE FROM uploads WHERE quote_id = $id";
  $res = pg_query($db, $sql);
  if ($res != true) {
    http_response_code(500);
    die();
  }
} else {
  http_response_code(403);
  header("location: /app/");
}
?>
