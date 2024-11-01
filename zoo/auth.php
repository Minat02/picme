<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['login'];
    $pass = $_POST['pass'];

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Изменяем запрос для получения пароля без хеширования
    $stmt = $conn->prepare("SELECT pass FROM users WHERE login = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->bind_result($Password);
    $stmt->fetch();
    $stmt->close();

    // Сравниваем введённый пароль с паролем из базы данных
    if ($pass === $Password) {
        // Успешная авторизация
        echo "<script>alert('Успешная авторизация'); window.location.href = 'main.php';</script>";
    } else {
        // Неверный логин или пароль
        echo "<script>alert('Неверный логин или пароль'); window.location.href = 'index.php';</script>";
    }

    $conn->close();
}
?>