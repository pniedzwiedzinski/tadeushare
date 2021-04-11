<?php
session_start();
if(!isset($_SESSION["user_id"])) {
  header("location: /app/login/");
  die();
}
require("../config.php");
require("../get/search.php");

function get_user() {
  $db = connect_db();
  $id = pg_escape_string($db, $_SESSION['user_id']);
  $sql = "SELECT name, surname, mail, password FROM \"user\" WHERE id = '$id'";
  $result = pg_query($db, $sql);
  if (pg_num_rows($result) == 1) {
    return pg_fetch_assoc($result);
  } else {
    header("location: /app/login/");
    die();
  }
}

function get_user_posts() {
  $db = connect_db();
  $id = pg_escape_string($db, $_SESSION['user_id']);
  $sql = "SELECT quote_id, content FROM \"uploads\" WHERE user_id = '$id'";
  $result = pg_query($db, $sql);
  $arr = [];
  while ($row = pg_fetch_assoc($result)) {
    $arr[] = [get_line($row['quote_id']), $row['quote_id'], substr($row['content'], 0, 10)];
  }
  return $arr;
}

function handle_post() {
  global $status, $err;
  $db = connect_db();

  if(isset($_POST["password"])) {
    # Aktualizuj hasło
    $row = get_user();
    if(password_verify($_POST["old_password"], $row["password"])) {
      $pass = pg_escape_string($db, password_hash($_POST['password'], PASSWORD_DEFAULT));
      $sql = "UPDATE \"user\" SET password = '$pass' WHERE id = ".$_SESSION["user_id"];
    } else {
      $err = "Błędne hasło";
      return;
    }

  } else {
    # Aktualizuj imię i nazwisko
    $name = pg_escape_string($db, $_POST['name']);
    $surname = pg_escape_string($db, $_POST['surname']);
    if (empty($name) || empty($surname)) {
      $err = "Podaj poprawne imię i nazwisko";
      return;
    }
    $sql = "UPDATE \"user\" SET name = '$name', surname = '$surname' WHERE id = ".$_SESSION["user_id"];
  }
  $res = pg_query($db, $sql);
  if ($res == TRUE) {
    $status = "Zaktualizowano dane 🎉";
  } else {
    $err = "Error: ".pg_result_error($res);
    return;
  }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
  handle_post();
}
$row = get_user();
$title = "Konto";
require("../header.php");
?>
<style>
form > div {
  height: 4em;
  display: grid;
  grid-template-columns: 1fr 1fr;
}

form input {
  font-size: 1em;
}

form > div > * {
  align-self: center;
}

li {
  margin: 1em 0;
}
</style>
<?php
if (isset($err)) {
  echo "<div class=\"error\">$err</div>";
} else if (isset($status)) {
  echo "<div class=\"success\">$status</div>";
}
?>
<h1>Udostępnione teksty</h1>
<div>
  <?php
$published = get_user_posts();
if (count($published) == 0) {
  echo "<p>Jeszcze nic nie przesłałeś</p>";
} else {
  echo "<ul>";
}
foreach ($published as $value) {
  echo "<li><a href=\"/g/$value[0]\">$value[0]</a> | <a href=\"/app/delete/?q=$value[1]\">❌</a></li>";
}
if (count($published) != 0) {
  echo "</ul>";
}
  ?>
</div>
<hr>
<h1>Ustawienia konta</h1>
<form method="POST">
  <div>
  <label for="name">Imię</label>
  <input type="text" name="name" id="name" value="<?php echo $row["name"]; ?>">
  </div>
  <div>
  <label for="surname">Nazwisko</label>
  <input type="text" name="surname" id="surname" value="<?php echo $row["surname"]; ?>">
  </div>
  <div>
  <label for="mail">Mail</label>
  <input type="text" name="mail" id="mail" value="<?php echo $row["mail"]; ?>" readonly>
  </div>
  <button class="button" style="font-size: 1em; margin-top: 2em" type="submit">Zaktualizuj</button>
</form>
<h2>Zmień hasło</h2>
<form method="POST">
  <div>
  <label for="old_password">Stare hasło</label>
  <input type="password" name="old_password" id="old_password">
  </div>
  <div>
  <label for="password">Nowe hasło</label>
  <input type="password" name="password" id="password">
  </div>
  <button class="button" style="font-size: 1em; margin-top: 2em" type="submit">Zmień</button>
</form>

<?php
?>
