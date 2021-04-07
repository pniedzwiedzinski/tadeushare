<?php
  session_start();
  require("only_anonymous.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    require("config.php");
    $db = mysqli_connect("$db_host:$db_port", $db_user, $db_pass, $db_name);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $mail = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, password_hash($_POST['password'], PASSWORD_DEFAULT));

    if ($_POST["poeta"] != "Mickiewicz") {
      $err = "Jest tylko jeden prawdziwy poeta!";
    } else if (empty($name) || empty($surname) || empty($mail) || empty($pass)) {
      $err = "Wypełnij wszystkie pola";
    } else {
      $s = "SELECT mail FROM user WHERE mail = '$mail'";
      $result = mysqli_query($db, $s);
      if (mysqli_num_rows($result) == 1) {
        $err = "Podany adres email jest już w użyciu";
      }
    }

    if (!isset($err)) {
      $sql = "INSERT INTO user (name, surname, mail, password) VALUES ('$name', '$surname', '$mail', '$pass')";
      if (mysqli_query($db, $sql) == TRUE) {
        header("Location: login.php");
      } else {
        $err = "Error: ".mysqli_error($db);
      }
    }
  }

  $title="Rejestracja";
  require('header.php');
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
  width: 100%;
  max-width: 20ex;
  margin-bottom: 1em;
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
  margin-top: 1em;
}

</style>
  <div class="login">
    <h1>Zarejestruj się</h1>
    <?php
    if (isset($err)) {
      echo "<div class=\"error\">";
      echo $err;
      echo "</div>";
    }
    ?>
    <form method="POST">
      <div class="input">
        <label for="name">Imię</label>
        <input type="text" id="name" name="name" required <?php if (isset($name)) {echo "value=\"$name\"";} ?>>
      </div>
      <div class="input">
        <label for="surname">Nazwisko</label>
        <input type="text" id="surname" name="surname" required>
      </div>
      <div class="input">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input">
        <label for="password">Hasło</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="input">
        <label for="poeta">Ulubiony poeta</label>
        <select id="poeta" name="poeta">
          <option value="Słowacki">Słowacki</option>
          <option value="Miłosz">Miłosz</option>
          <option value="Mickiewicz">Mickiewicz</option>
          <option value="Szymborska">Szymborska</option>
        </select>
      </div>
      <button class="button" type="submit">Zarejestruj się</button>
    </form>
    <p>Masz już konto? <a href="login.php">Zaloguj się</a></p>
  </div>

<?php
  require('footer.php');
?>
