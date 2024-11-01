<?php
require_once "db.php";
echo $kid_id = $_COOKIE['kid_id'];
echo $animal_id = $_GET['id'];

$sql = "INSERT INTO seen (kid_id, animal_id) VALUES ('$kid_id', '$animal_id')";
if($conn->query($sql)){
    echo "Данные успешно добавлены! Сейчас вернемся к списку животных!";
	header ("Location: main.php");
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();
?>