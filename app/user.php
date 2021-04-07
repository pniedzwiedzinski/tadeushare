<?php
session_start();
if(!isset($_SESSION["user_id"])) {
  header("location: login.php");
  die();
}

require("config.php");
$db = mysqli_connect("$db_host:$db_port", $db_user, $db_pass, $db_name);
$id = mysqli_real_escape_string($db, $_SESSION['user_id']);
$sql = "SELECT name, surname, mail, password FROM user WHERE id = '$id'";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
} else {
  header("location: login.php");
  die();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(password_verify($_POST["old_password"], $row["password"])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $pass = mysqli_real_escape_string($db, password_hash($_POST['password'], PASSWORD_DEFAULT));
    $sql = "UPDATE user SET name = '$name', surname = '$surname', password = '$pass' WHERE id = '$id'";
    if (mysqli_query($db, $sql) == TRUE) {
      $status = "Zaktualizowano dane 🎉";
    } else {
      $err = "Error: ".mysqli_error($db);
    }
  } else {
    $err = "Błędne hasło";
  }
}
$title = "Konto";
require("header.php");
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
</style>
<h1>Ustawienia konta</h1>
<?php
if (isset($err)) {
  echo "<div class=\"error\">$err</div>";
} else if (isset($status)) {
  echo "<div class=\"success\">$status</div>";
}
?>
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
  <div>
  <label for="old_password">Stare hasło</label>
  <input type="password" name="old_password" id="old_password">
  </div>
  <div>
  <label for="password">Nowe hasło</label>
  <input type="password" name="password" id="password">
  </div>
  <button class="button" style="font-size: 1em; margin-top: 2em" type="submit">Zaktualizuj</button>
</form>

<?php
?>
