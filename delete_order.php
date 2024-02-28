<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modeliDesign";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_GET['id'];

        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM form_data WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redirect back to the view_orders.php page after deletion
        header("Location: view_orders.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
