<?php
function too_soon(){
	//return true if signup is not live yet
	date_default_timezone_set('America/Chicago'); // CDT
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	if($month > 4){
		return false;
	}
	else if ($month == 4 && $date > 28){
		return false;
	}
	else if($month == 4 && $date == 28 && $hour >= 14){
		return false;
	}
	else{
		return true;
	}
}

if(too_soon()){
	die("Signup is not live until Friday, 4/28/17 at 2:00 PM.");
}

require_once('db.php');
$first = trim(mysqli_real_escape_string($conn,$_POST['first']));
$last = trim(mysqli_real_escape_string($conn,$_POST['last']));
$placement = $_POST['placement'];

$signups = null;
$maxstudents = null;

$sql = "SELECT COUNT(placement) FROM volunteers WHERE placement=$placement";
if($result=mysqli_query($conn,$sql)){
	$row = mysqli_fetch_array($result);
	$signups = $row[0];
} else{die(mysqli_error($conn));}

$sql = "SELECT maxstudents FROM placements WHERE id = $placement";
if($result=mysqli_query($conn,$sql)){
	$row = mysqli_fetch_array($result);
	$maxstudents = $row[0];
} else{die(mysqli_error($conn));}

if($maxstudents > $signups){
	$pointless = "pointless";
	//sign up
	// echo "The placement has room.";
} else {die("This placement has filled. Please select a different one.");}

$id = null;
$first_lower = trim(strtolower($first));
$last_lower = trim(strtolower($last));
$sql ="SELECT id FROM volunteers WHERE LOWER(first)='$first_lower' AND LOWER(last)='$last_lower'";
if($result = mysqli_query($conn,$sql)){
	if($row = mysqli_fetch_array($result)){$id = $row[0];
	} else{$id="\"\"";}
} else{die(mysqli_error($conn));}

$sql ="REPLACE INTO volunteers (id, first, last, placement) VALUES ($id, '$first', '$last', $placement)";
if($result = mysqli_query($conn,$sql)){
	echo "Successfully signed up for placement.";
} else{die(mysqli_error($conn));}

mysqli_close($conn);
?>