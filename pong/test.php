
<?php   require('db.php'); 




$sql  = "select * from item order by id";
$query = $conn->query($sql);
$List2 = [];
$tmp2 = [];
while($rec = $query->fetch_assoc()){

	echo $rec['id']." ".$rec['probability'];
	echo "<br>";
	array_push($List2,$rec['probability']);
	array_push($tmp2,$rec['id']);


}
//print_r($List2);
//echo "<br>";
//print_r($tmp2);

$List = [];
$tmp = [];
foreach($List2 as $index=>$item)
{
	for($i=0; $i<$item*100; $i++)
	{
	array_push($List,$item);
	array_push($tmp,$tmp2[$index]);
	}
}
$random_keys=array_rand($List,1);



echo "id:".$tmp[$random_keys]."<br> "."prob: ".$List[$random_keys];

return exit();

?>

