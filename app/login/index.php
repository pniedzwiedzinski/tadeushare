<?php
  session_start();

  require("../only_anonymous.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    require("../config.php");
    $db = connect_db();
    $mail = pg_escape_string($db, $_POST['email']);

    $sql = "SELECT id, password FROM \"user\" WHERE mail = '$mail'";
    $result = pg_query($db, $sql);
    $row = pg_fetch_assoc($result);
    if (!empty($row) && password_verify($_POST["password"], $row["password"])) {
      $_SESSION["user_id"] = $row["id"];
      header("Location: /app/");
      die();
    } else {
      $err = "Niepoprawne dane logowania";
    }
  }

  $title="Login";
  require('../header_blank.php');
?>
<style>
.login {
  margin: 2em;
  padding: 2em;
  background: white;
  box-shadow: 0 0 15px #aaa;
}

.input {
  height: 4em;
}

form > *,
.input * {
  display: block;
}

form {
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
margin: 3em 0;
}

.button {
  margin-top: 2em;
}

.error {
  color: red;
}

.error::before {
  content: '❗ ';
  color: red;
}
</style>
  <div class="login">
    <h1>Zaloguj się</h1>
    <?php
    if (isset($err)) {
      echo "<div class=\"error\">";
      echo $err;
      echo "</div>";
    }
    ?>
    <form method="POST">
      <div class="input">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
      </div>
      <div class="input">
      <label for="password">Hasło</label>
      <input type="password" id="password" name="password" required>
      </div>
      <button class="button" type="submit">Zaloguj się</button>
    </form>
    <p>Nie masz konta? <a href="/app/register/">Zarejestruj się</a></p>
  </div>

<?php
  require('../footer.php');
?>
