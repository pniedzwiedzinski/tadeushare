<?php

function search($str) {
  if (!preg_match('/^[a-z\-]+$/', $str)) {
    return null;
  }
  $output=null;
  $retval=null;
  exec("grep -n '$str' ../data.txt", $output, $retval);
  $id = explode(":", $output[0])[0];
  return $id;
}

function get_line($num) {
  $output=null;
  $retval=null;
  exec("sed '$num!d' ../data.txt", $output, $retval);
  return $output[0];
}

?>
