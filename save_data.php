<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BooksAndOthersDB";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputText = $_POST["inputText"];
    $choice = $_POST["choice"];

    if (empty($inputText) || empty($choice)) {
        die("Input and choice fields are required.");
    }

    $sql = "INSERT INTO UserInputs (inputText, choice) VALUES ('$inputText', '$choice')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "New record created successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

$conn->close();
?>
