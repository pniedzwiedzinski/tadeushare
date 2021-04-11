<?php
# Ten plik przekierowuje na stronę główną wszystkich zalogowanych użytkowników
if (isset($_SESSION["user_id"])) {
  header("location: /app/");
}
?>
