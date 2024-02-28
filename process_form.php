<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modeliDesign";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare SQL statement to insert form data into the database
        $stmt = $conn->prepare("INSERT INTO form_data (instagram_username, full_name, country, address, phone_number, delivery_date, order_date, dress_model, postal_code, comment) VALUES (:instagram_username, :full_name, :country, :address, :phone_number, :delivery_date, :order_date, :dress_model, :postal_code, :comment)");

        // Bind parameters excluding the image path
        $stmt->bindParam(':instagram_username', $_POST['instagram_username']);
        $stmt->bindParam(':full_name', $_POST['full_name']);
        $stmt->bindParam(':country', $_POST['country']);
        $stmt->bindParam(':address', $_POST['address']);
        $stmt->bindParam(':phone_number', $_POST['phone_number']);
        $stmt->bindParam(':delivery_date', $_POST['delivery_date']);
        $stmt->bindParam(':order_date', $_POST['order_date']);
        $stmt->bindParam(':dress_model', $_POST['dress_model']);
        $stmt->bindParam(':postal_code', $_POST['postal_code']);
        $stmt->bindParam(':comment', $_POST['comment']);

        // Execute the SQL statement
        $stmt->execute();
        $lastInsertId = $conn->lastInsertId();

        if (isset($_FILES['dress_image']) && $_FILES['dress_image']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['dress_image']['tmp_name'];
            $file_name = $_FILES['dress_image']['name'];
            $file_destination = "uploads/" . $file_name; // Specify the upload directory

            // Move the uploaded file to the specified directory
            move_uploaded_file($file_tmp, $file_destination);

            // Update the record with the image path
            $stmt = $conn->prepare("UPDATE form_data SET image_path = :image_path WHERE id = :id");
            $stmt->bindParam(':image_path', $file_destination);
            $stmt->bindParam(':id', $lastInsertId);
            $stmt->execute();
        }

        header("Location: index.php");
        echo '<script>alert("POROSIA U SHTUA ME SUKSES");</script>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
