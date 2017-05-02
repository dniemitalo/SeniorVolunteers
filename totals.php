<?php
require_once('db.php');
$sql = "SELECT placements.topic, COUNT(volunteers.placement) as NumSignups FROM volunteers JOIN placements ON placements.id = volunteers.placement GROUP BY topic";
$result = mysqli_query($conn,$sql);
?>
<table>
<tr>
	<td>Topic</td>
	<td>Period</td>
	<td>Students</td>
</tr>
<?php
while ($row=mysqli_fetch_assoc($result)){
echo '<tr>';
echo "\t<td>{$row['topic']}</td>";
echo "\t<td>{$row['period']}</td>";
echo "\t<td>{$row['NumSignups']}</td>";
echo "</tr>\n";
}

mysqli_close($conn);
?>
</table>

