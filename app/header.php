<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo "$title - Tadeushare"; ?></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="container">
      <header>
        <nav>
          <a href="index.php">Tadeushare</a>
<?php
  if (isset($_SESSION["user_id"])) {
    echo "<a href=\"user.php\">Konto</a>\n";
    echo "<a href=\"logout.php\">Wyloguj się</a>";
  } else {
    echo "<a href=\"login.php\">Zaloguj się</a>";
  }
?>
        </nav>
      </header>
      <main>
