<?php
function too_soon(){
	//return true if signup is not live yet
	date_default_timezone_set('America/Chicago'); // CDT
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	$current_date = "$date/$month/$year $hour:$min:$sec";
	echo $current_date . "<br>";
	if($month > 4){
		echo "Month is greater than 4.";
		return false;
	}
	else if ($month == 4 && $date > 27){
		echo "Month is 4 and date is greater than 27. Date: $date<br>";
		echo "$month $year $hour $min $sec $date";
		return false;
	}
	else if($month == 4 && $date == 27 && $hour >= 10){
		echo "We are on 4/27 and the hour is at least 10";
		return false;
	}
	else{
		echo "Date is before 4/27 10:00.";
		return true;
	}
}
too_soon();
?>