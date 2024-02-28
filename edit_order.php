<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modeliDesign";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if 'id' parameter is set and fetch order details
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM form_data WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $order = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "No order ID provided.";
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>EDITOJE POROSIN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        label {
            flex: 0 0 48%;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            appearance: none;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        img {
            max-width: 200px;
            height: auto;
            margin-top: 10px;
        }

        /* Added CSS */
        .form-section {
            width: 48%; /* Set the width of each section */
            display: inline-block; /* Display sections inline */
            vertical-align: top; /* Align sections to the top */
            margin-bottom: 20px; /* Add spacing between sections */
        }
    </style>
</head>
<body>
    <h1>EDITOJE POROSIN</h1>
    <form action="update_order.php" method="POST" enctype="multipart/form-data">
        <div  class="form-section"> 
<input type="hidden" name="id" value="<?php echo $order['id']; ?>">
        
        <!-- Display form fields for editing -->
        <label for="instagram_username">Emri i Instagramit:</label>
        <input type="text" id="instagram_username" name="instagram_username" value="<?php echo $order['instagram_username']; ?>">

        <label for="full_name">Emri dhe Mbiemri i personit:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $order['full_name']; ?>">
        
        <!-- Add other input fields for order details -->
        <label for="country">Shteti:</label>
        <select id="country" name="country">
            <!-- Add options as before -->
        </select>

        <label for="address">Qyteti/Adresa:</label>
        <textarea id="address" name="address"><?php echo $order['address']; ?></textarea>
        
        <label for="phone_number">Numri i Telefonit:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $order['phone_number']; ?>">
        
        <label for="delivery_date">Data e Dorzimit:</label>
        <input type="date" id="delivery_date" name="delivery_date" value="<?php echo $order['delivery_date']; ?>">
        
        <label for="order_date">Data e Porosis:</label>
        <input type="date" id="order_date" name="order_date" value="<?php echo $order['order_date']; ?>">
        </div>
        <div  class="form-section">
  <label for="dress_model">Modeli i Fustanit:</label>
        <input type="text" id="dress_model" name="dress_model" value="<?php echo $order['dress_model']; ?>">
        
        <label for="postal_code">Kodi Postar:</label>
        <input type="text" id="postal_code" name="postal_code" value="<?php echo $order['postal_code']; ?>">
        
        <label for="comment">Komenti:</label>
        <textarea id="comment" name="comment"><?php echo $order['comment']; ?></textarea>
        
        <label for="image">Foto e Fustanit:</label>
        <input type="file" id="image" name="image">
        <br>
        <?php if ($order['image_path']) : ?>
            <img src="<?php echo $order['image_path']; ?>" alt="Order Image">
        <?php else : ?>
            <p>ASNJE FOTO NUK ESHT POSTUAR PER KET POROSI</p>
        <?php endif; ?>
        
        <input type="submit" value="RUAJ POROSIN">
        </div>
        
        
        <button type="button" onclick="printPage()">PRINTOJE FAQEN</button>

        <script>
            function printPage() {
                window.print();
            }
        </script>
    </form>
</body>
</html>
