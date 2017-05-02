<?php
require_once('db.php');
$sql = "DELETE FROM volunteers WHERE id={$_GET['id']}";
mysqli_query($conn,$sql);	
?>