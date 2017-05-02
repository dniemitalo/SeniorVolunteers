<?php
require_once('db.php');
$sql = "SELECT first, last, topic as placement FROM volunteers JOIN placements ON placements.id = volunteers.placement ORDER BY placement, last, first";
$result = mysqli_query($conn,$sql);
echo "<table>";
while($row = mysqli_fetch_assoc($result)){
	$first=$row['first'];
	$last=$row['last'];
	$placement=$row['placement'];
	echo "<tr><td>$first</td><td>$last</td><td>$placement</td></tr>";
}
echo "</table>";
mysqli_close($conn);
?>