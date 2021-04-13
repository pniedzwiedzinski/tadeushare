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
  border: 1px solid #888;
  resize: none;
  font-family: sans-serif;
  padding: 1ex;
}
</style>
<form method="POST" action="/app/upload/">
  <textarea placeholder="Wklej tutaj" cols="20" rows="20" name="text" id="text"></textarea>
  <button class="button" id="submit">Prześlij</button>
</form>
</main>
<?php
  require("footer.php");
?>
