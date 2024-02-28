<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modeliDesign";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        // Handle image upload
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = $_FILES['image']['name'];
            $file_destination = "uploads/" . $file_name; // Specify the upload directory

            // Move the uploaded file to the specified directory
            move_uploaded_file($file_tmp, $file_destination);

            // Update image path in the database
            $stmt = $conn->prepare("UPDATE form_data SET image_path = :image_path WHERE id = :id");
            $stmt->bindParam(':image_path', $file_destination);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        // Update other order details in the database
        $stmt = $conn->prepare("UPDATE form_data SET 
            instagram_username = :instagram_username,
            full_name = :full_name,
            country = :country,
            address = :address,
            phone_number = :phone_number,
            delivery_date = :delivery_date,
            order_date = :order_date,
            dress_model = :dress_model,
            postal_code = :postal_code,
            comment = :comment
            WHERE id = :id");

        // Bind other form data parameters
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
        $stmt->bindParam(':id', $id);

        // Execute the query to update other order details
        $stmt->execute();

        // Redirect to a confirmation page or back to the view orders page
        header("Location: view_orders.php");
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
