<?php
require_once('db.php');
$sql = "DELETE FROM placements WHERE id={$_GET['id']}";
if(mysqli_query($conn,$sql)){
	echo "Deleted placement option.";
}
else{
	echo mysqli_error($conn);
}
mysqli_close($conn);
?>