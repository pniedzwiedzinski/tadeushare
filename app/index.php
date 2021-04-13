<?php
  $title = "Home";
  session_start();
  require("header.php");
?>
<style>
textarea {
  width: 100%;
  margin: 1em;
  border: 1px solid #888;
  resize: none;
  font-family: sans-serif;
  padding: 1ex;
}

#all {
margin: 3em 0;
width: 100%;
text-align: center;
}
</style>
<form method="POST" action="/app/upload/">
  <textarea placeholder="Wklej tutaj" cols="20" rows="20" name="text" id="text"></textarea>
  <button class="button" id="submit">Prześlij</button>
</form>
<div id="all">
  <a href="data.txt">Wszystkie cytaty</a>
</div>
<?php
  require("footer.php");
?>
