<?php 

	// db connection
function db_connect() {
	$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	confirm_db_connection($connection);
	return $connection;
}

function confirm_db_connection($connection) {
	if ($connection->errno) {
		$msg = "Database connection failed. ";
		$msg .= $connection->error . " (" . $connection->errno . ")";
		exit($msg);
	}
}

function db_disconnect($connection) {
	$connection->close();
}










 ?>