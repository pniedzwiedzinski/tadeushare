<?php

function connect_db() {
  $url = getenv("DATABASE_URL");
  $db_user = parse_url($url, PHP_URL_USER);
  $db_pass = parse_url($url, PHP_URL_PASS);
  $db_host = parse_url($url, PHP_URL_HOST);
  $db_port = parse_url($url, PHP_URL_PORT);
  $db_name = explode("/", parse_url($url, PHP_URL_PATH))[1];
  /* $db_host = getenv("DB_HOST"); */
  /* $db_port = getenv("DB_PORT"); */
  /* $db_name = getenv("DB_NAME"); */
  /* $db_user = getenv("DB_USER"); */
  /* $db_pass = getenv("DB_PASSWORD"); */
  $postgres = "host=$db_host port=$db_port dbname=$db_name user=$db_user password=$db_pass options='--client_encoding=UTF8'";

  return pg_connect($postgres);
}

?>
