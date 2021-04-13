<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(password_verify($_POST["password"], getenv("ADMIN_PASSWORD"))) {
    $_SESSION["admin"] = true;
    header("location: /app/admin/");
    die();
  } else {
    $err = "<p>Wrong password</p><img src=\"https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fkipmooney.com%2Fwp-content%2Fuploads%2F2012%2F02%2Fgandalfmeme.jpg&f=1&nofb=1\">";
  }
}

$title = "Admin";
require("../header.php");
if (!isset($_SESSION["admin"])) {
  if (isset($err)) {
    echo "<div class=\"error\">$err</div>";
  }
  echo <<< END
<form method="POST">
  <label for="password">Hasło:</label>
  <input type="password" name="password" id="password">
  <button type="submit">Dalej</button>
</form>
END;
} else {
  echo "<h1>Panel admina</h1>";
  echo "<a href=\"exit.php\">Wyjdź z trybu admina</a>";
  require("../config.php");
  $db = connect_db();
  $sql = "SELECT * FROM \"user\"";
  $res = pg_query($db, $sql);
  echo "<h2>Użytkownicy</h2><ol>";
  while($row = pg_fetch_assoc($res)) {
    echo "<li>".$row["name"]." ".$row["surname"]." - ".$row["mail"]." | <a href=\"delete.php?id=".$row["id"]."\">❌</a></li>";
  }
  echo "</ol>";

  $sql = "SELECT * FROM \"uploads\"";
  $res = pg_query($db, $sql);
  echo "<h2>Przesłane teksty</h2><ol>";
  require("../get/search.php");
  while($row = pg_fetch_assoc($res)) {
    $quote = get_line($row["quote_id"]);
    echo "<li><a href=\"/g/$quote\">$quote</a> | <a href=\"/app/delete/?q=".$row["quote_id"]."\">❌</a></li>";
  }
  echo "</ol>";

}
require("../footer.php");
?>
