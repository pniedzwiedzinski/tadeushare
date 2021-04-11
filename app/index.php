<?php
  $title = "Home";
  session_start();
  require("header.php");
?>
<main>
<style>
textarea {
  width: 100%;
  margin: 1em;
}
</style>
<form method="POST" action="upload.php">
  <textarea cols="20" rows="20" name="text" id="text"></textarea>
  <button class="button" id="submit">Prześlij</button>
</form>
</main>
<?php
  require("footer.php");
?>
