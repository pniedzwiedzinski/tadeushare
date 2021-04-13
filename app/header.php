<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo "$title - Tadeushare"; ?></title>
    <link rel="stylesheet" href="/app/style.css">
  </head>
  <body>
    <div id="container">
      <header>
        <nav>
<?php
if (isset($_SESSION["admin"])) {
    echo "<a href=\"/app/admin/\" style=\"color: red\">ADMIN</a>";
}
?>
          <a href="/app/">Tadeushare</a>
<?php
  if (isset($_SESSION["user_id"])) {
    echo "<a href=\"/app/user/\">Konto</a>\n";
    echo "<a href=\"/app/logout/\">Wyloguj się</a>";
  } else {
    echo "<a href=\"/app/login/\">Zaloguj się</a>";
  }
?>
        </nav>
      </header>
      <main>
