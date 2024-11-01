<?php
require_once "db.php";
?>
<html>
<head>
<title>Животные нашего зоопарка</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div>

<?php
$sql = "SELECT * FROM kids";
if($result = $conn->query($sql)){
    foreach($result as $row){
     $kid_id = $row["id"];
     $kid_name = $row["name"];
     $kid_familia = $row["familia"];
	 
	  echo "<a href='main.php?id=$kid_id&name=$kid_name'>".$kid_name." ".$kid_familia."</a>";
      echo "<br>";
	}
}
?>

</div>
</body>
</html>