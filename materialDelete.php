<?php
include("conn.php");

$materialID = $_REQUEST["mid"];

$sql_delete = "DELETE FROM material WHERE materialID = '$materialID'";

$conn->query($sql_delete);
?>
