<?php
session_start();
include("conn.php");

$materialID = $_REQUEST["mid"];

$sql_delete = "UPDATE material SET materialStatus='Unavailable' WHERE materialID = '$materialID'";
$sql_deleteFromCollector = "DELETE FROM registeredmaterial WHERE materialID = '$materialID'";

$conn->query($sql_delete);
$conn->query($sql_deleteFromCollector);
?>
