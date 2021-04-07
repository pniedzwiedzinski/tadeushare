<?php
  $title = "Home";
  session_start();
  require("header.php");
?>
<nav>
<ul>
<?php
  if (isset($_SESSION["user_id"])) {
    echo "<li><a href=\"user.php\">Konto</a></li>";
    echo "<li><a href=\"logout.php\">Wyloguj się</a></li>";
  } else {
    echo "<li><a href=\"login.php\">Zaloguj się</a></li>";
  }
?>
</ul>
</nav>
<main>
<textarea id="submitText"></textarea>
<button id="submit">Prześlij</button>
</main>
<?php
  require("footer.php");
?>
