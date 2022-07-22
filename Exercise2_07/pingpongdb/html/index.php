<?php 

$db = getenv('POSTGRES_DB');
$table = getenv('POSTGRES_TABLE');
$user = getenv('POSTGRES_USER');
$password = getenv('POSTGRES_PASSWORD');
$pghost = getenv('PGHOST');
$add_command = getenv('ADD_COMMAND');
$get_command = getenv('GET_COMMAND');

$db_conn = pg_connect("host=$pghost port=5432 dbname=$db user=$user password=$password");
if (!$db_conn) {
  echo "Failed connecting to postgres database $db\n";
  exit;
}

$qu = pg_query($db_conn, $add_command . $get_command);

while ($data = pg_fetch_object($qu)) {
  echo "PONG " . $data->max;
}

?>