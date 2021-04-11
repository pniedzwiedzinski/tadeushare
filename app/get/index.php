<?php

if(empty($_GET["q"])) {
  header("location: /app");
  die();
}

require("../config.php");
$db = connect_db();
$id = pg_escape_string($db, $_GET["q"]);
$sql = "SELECT content FROM \"uploads\" JOIN quotes ON quotes.id = uploads.quote_id WHERE quote = '$id'";
$res = pg_query($db, $sql);
$row = pg_fetch_assoc($res);
if (empty($row)) {
  http_response_code(404);
} else {
  header('Content-Type: text/plain');
  echo $row["content"];
}
