<?php

if(empty($_GET["q"])) {
  header("location: /app");
  die();
}

require("../config.php");
$db = connect_db();
require("search.php");
$id = search(pg_escape_string($db, $_GET["q"]));
$sql = "SELECT content FROM \"uploads\" WHERE quote_id = $id";
$res = pg_query($db, $sql);
$row = pg_fetch_assoc($res);
if (empty($row)) {
  http_response_code(404);
  header('location: /app/');
} else {
  header('Content-Type: text/plain');
  echo $row["content"];
}
