<?php
require_once('db.php');
$sql = "SELECT placements.id, placements.topic as placement, COUNT(volunteers.placement) as studentCount FROM volunteers JOIN placements ON placements.id = volunteers.placement GROUP BY placement";
$result = mysqli_query($conn,$sql);
$output_array = array();
while($row = mysqli_fetch_assoc($result)){
	$output_array[] = $row;
}
echo json_encode($output_array);
mysqli_close($conn);
?>