<?php
require_once 'db.php';

$teacher = mysqli_real_escape_string($conn,$_GET['teacher']);
$room = mysqli_real_escape_string($conn,$_GET['room']);
$topic = mysqli_real_escape_string($conn,$_GET['topic']);
$facilitators = mysqli_real_escape_string($conn,$_GET['facilitators']);
$maxstudents = mysqli_real_escape_string($conn,$_GET['maxstudents']);
$sql = "INSERT INTO placements (teacher, room, topic, facilitators, maxstudents) VALUES ('$teacher','$room','$topic','$facilitators','$maxstudents')";

if(mysqli_query($conn, $sql)){
echo "Placement saved successfully.";
} else{
echo "<br>Error:<br>".mysqli_error($conn);
}
mysqli_close($conn);
?>