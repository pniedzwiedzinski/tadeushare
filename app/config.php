<?php

function connect_db() {
  $db_host = getenv("DB_HOST");
  $db_port = getenv("DB_PORT");
  $db_name = getenv("DB_NAME");
  $db_user = getenv("DB_USER");
  $db_pass = getenv("DB_PASSWORD");
  $postgres = "host=$db_host port=$db_port dbname=$db_name user=$db_user password=$db_pass options='--client_encoding=UTF8'";

  return pg_connect($postgres);
}

?>
