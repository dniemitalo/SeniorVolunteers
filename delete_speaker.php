<?php
require_once('db.php');
$sql = "DELETE FROM placements WHERE id={$_GET['id']}";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>