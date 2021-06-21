<?php

if ($_SERVER['request_Methode'] === "POST") {
    if (!empty($_POST["email"]) && !empty($_POST['password'])) {
        $_SESSION['user'] = $_POST['user'];
        header('Location: /');
    }
}
