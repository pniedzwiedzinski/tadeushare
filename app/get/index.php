<?php

session_start();
if(empty($_GET["q"])) {
  header("location: /app");
  die();
}

require("../config.php");
$db = connect_db();
require("search.php");
$id = search(pg_escape_string($db, $_GET["q"]));
if ($id == null) {
  http_response_code(404);
  die();
}
$sql = "SELECT content FROM \"uploads\" WHERE quote_id = $id";
$res = pg_query($db, $sql);
$row = pg_fetch_assoc($res);
if (empty($row)) {
  http_response_code(404);
  die();
} else {
  $title = $_GET["q"];
  require("../header.php");
  echo "<h1>".$_GET["q"]."</h1>";
  echo "<a href=\"/r/".$_GET["q"]."\">raw</a>";
  echo "<textarea style=\"width: 100%\" rows=\"20\" readonly>".$row["content"]."</textarea>";
  require("../footer.php");
}
?>
<style>
textarea {
  margin: 1em;
}
</style>
