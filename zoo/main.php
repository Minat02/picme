<?php
require_once "db.php";
//если установлена cookies, используем ее
if (isset ($_GET['id']) AND isset($_GET['name'])){
	$kid_id = $_GET['id'];
	$kid_name = $_GET['name'];
	setcookie("kid_id", $kid_id, time() + 3600);
	setcookie("kid_name", $kid_name, time() + 3600);
	header ("Location: main.php");
}
/* else {
	header("location: index.php");
} */


?>
<html>
<head>
<title>Животные</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$kid_n = $_COOKIE['kid_name'];
$kid_id = $_COOKIE['kid_id'];

//Делаем выборку животных, которых видели и вносим в массив
$animals = [];
$sql_seen = "SELECT * FROM seen WHERE kid_id='$kid_id'";
if($result_seen = $conn->query($sql_seen)){
    foreach($result_seen as $row_seen){
         
       // echo  $seen_animal_id = $row_seen["animal_id"];
		array_push($animals, $row_seen["animal_id"]);
            }
}

print_r($animals);
//закончили выборку

echo "Привет, ".$kid_n;
echo "<br>";
$sql = "SELECT * FROM animals";
if($result = $conn->query($sql)){
    foreach($result as $row){
         
         $animal_id = $row["id"];
         $animal_name = $row["name"];
         $animal_pic = $row["pic"]; 
		 if (in_array($animal_id, $animals)){
			 
			// echo "<img src='animals/$animal_pic' height='150' class='seen'>";
  echo "<div style='position: relative;'>";
  echo "<div style='position: absolute; z-index: 1;'><img src='animals/$animal_pic' height='150' class='seen'></div>";
  echo "<div style='position: absolute; z-index: 2; top: 20; left: 20;'><img src='images/mark.png'></div>";
  echo "</div>";

		 }
		 else {
			
			echo "<a href='markanimal.php?id=$animal_id'><img src='animals/$animal_pic' height='150'></a>";

		 }
    }
}
?>
</body>
</html>