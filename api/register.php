<?php

require("./utils/functions.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    sendResponse(false, "Invalid request method");
}

if (!isset($_POST["name"])) {
    sendResponse(false, "Name is required");
}
if (!isset($_POST["email"])) {
    sendResponse(false, "Email is required");
}
if (!isset($_POST["age"])) {
    sendResponse(false, "Age is required");
}
if (!isset($_POST["dob"])) {
    sendResponse(false, "DOB is required");
}
if (!isset($_POST["password"])) {
    sendResponse(false, "Password is required");
}

$name = $_POST["name"];
$email = $_POST["email"];
$age = $_POST["age"];
$dob = $_POST["dob"];
$password = md5($_POST["password"]);

// if (strlen($name) < 3 || strlen($email) > 25) {
//     sendResponse(false, "Name must be at least 3 characters and at most 25 characters");
// }

$pdo = connect();

$query = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam("email", $email, PDO::PARAM_STR);

$stmt->execute();
if ($stmt->rowCount() > 0) {
    sendResponse(false, "Email already exists");
}


$query = "INSERT INTO users(name, email, age, dob, password) VALUES (:name, :email, :age, :dob, :password)";

$stmt = $pdo->prepare($query);
$stmt->bindParam("name", $name, PDO::PARAM_STR);
$stmt->bindParam("email", $email, PDO::PARAM_STR);
$stmt->bindParam("age", $age, PDO::PARAM_STR);
$stmt->bindParam("dob", $dob, PDO::PARAM_STR);
$stmt->bindParam("password", $password, PDO::PARAM_STR);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    sendResponse(true, "Registered Successfully");
}

sendResponse(false, "User registration failed");