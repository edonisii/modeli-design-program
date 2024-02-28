<!DOCTYPE html>
<html>
<head>
    <title>Reminder Page</title>
    <!-- Add your CSS styles or link to an external CSS file -->
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .reminder-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .reminder-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>POROSIT PER DATEN E NESERME</h1>
    <div class="reminder-container">
        <!-- Display fetched reminders here -->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "modeliDesign";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Get today's date
            $today = date('Y-m-d');

            // Get tomorrow's date
            $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'));

            // Fetch orders scheduled for tomorrow with Instagram usernames
            $stmt = $conn->prepare("SELECT instagram_username, delivery_date FROM form_data WHERE delivery_date = :delivery_date");
            $stmt->bindParam(':delivery_date', $tomorrow);
            $stmt->execute();
            $nextDayOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display fetched reminders with Instagram usernames
            foreach ($nextDayOrders as $order) {
                echo "<div class='reminder-item'>";
                echo "EMRI I INSTAGRAMIT: " . $order['instagram_username'] . ", DATA E DORZIMIT: " . $order['delivery_date'];
                echo "</div>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
