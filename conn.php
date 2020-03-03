<?php

$conn = new mysqli("localhost", "root","", "oneplanet");
if ( $conn->connect_error) {
	die ("Connection failure" );

echo ("Connect successfully");
}
 ?>
