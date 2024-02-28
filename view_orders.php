<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "modeliDesign";

// Number of records per page
$recordsPerPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startFrom = ($page - 1) * $recordsPerPage;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch orders from the database based on search or fetch all orders if search is empty
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $stmt = $conn->prepare("SELECT * FROM form_data WHERE instagram_username LIKE :search LIMIT $startFrom, $recordsPerPage");
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $conn->prepare("SELECT * FROM form_data LIMIT $startFrom, $recordsPerPage");
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total number of records
    $totalRecords = $conn->query("SELECT COUNT(*) FROM form_data")->fetchColumn();
    $totalPages = ceil($totalRecords / $recordsPerPage);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <style>
        /* Add CSS styles for table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Style for images */
        .order-image {
            max-width: 100px;
            max-height: 100px;
        }
        <style>
        /* Add CSS styles for table */
        /* ... (existing table styles) ... */

        /* Style for buttons */
        .action-buttons a {
            display: inline-block;
            padding: 6px 12px;
            margin: 3px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .action-buttons a.edit-button {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .action-buttons a.delete-button {
            background-color: #f44336;
            color: white;
            border: 1px solid #f44336;
        }

        .action-buttons a:hover {
            opacity: 0.8;
        }
        .search-form {
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 6px;
            width: 250px;
        }

        .search-form button {
            padding: 6px 12px;
        }
 
    </style>
</head>
<body>
<?php include 'header.php'; ?>
    <h1>SHIKOJ TE GJITHA POROSIT</h1>
    <form method="GET" action="">
    <div class="search-form">
        <input type="text" name="search" placeholder="KERKOJ ME EMER TE INSTAGRAMIT">
        <button type="submit">KERKO</button>
        <a href="view_orders.php">PASTROJE</a>
    </div>
</form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri Instagram</th>
                <th>Emri/Mbiemri</th>
                <th>Shteti</th>
                <th>Adresa</th>
                <th>Numri Telefonit</th>
                <th>Data E Dorzimit</th>
                <th>Data E Porosis</th>
                <th>Modeli I Fustanit</th>
                <th>Kodi Postar</th>
                <th>Komenti</th>
                <th>Foto</th> <!-- Added Image Column -->
                <th>Butonat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <!-- Display order details -->
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['instagram_username']; ?></td>
                    <td><?php echo $order['full_name']; ?></td>
                    <td><?php echo $order['country']; ?></td>
                    <td><?php echo $order['address']; ?></td>
                    <td><?php echo $order['phone_number']; ?></td>
                    <td><?php echo $order['delivery_date']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['dress_model']; ?></td>
                    <td><?php echo $order['postal_code']; ?></td>
                    <td><?php echo $order['comment']; ?></td>
                    <td>
                        <?php
                        // Assuming 'image_path' is the column name in the database
                        $imagePath = $order['image_path'];
                        if ($imagePath && file_exists($imagePath)) {
                            echo '<img src="' . $imagePath . '" class="order-image" />';
                        } else {
                            echo 'No Image';
                        }
                        ?>
                    </td>

                    <!-- Edit and Delete buttons -->
                    <td class="action-buttons">
                        <a href="edit_order.php?id=<?php echo $order['id']; ?>" class="edit-button">EDITOJE</a>
                   
                            <a href="delete_order.php?id=<?php echo $order['id']; ?>" class="delete-button" onclick="return confirm('A jeni te sigurt qe deshironi me e fshi porosin?')">FSHIJE</a>
                    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?><?php if(isset($_GET['search'])) echo "&search=" . $_GET['search']; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>
