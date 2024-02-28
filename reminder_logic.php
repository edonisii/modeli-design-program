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
        echo "INSTAGRAM USERNAME: " . $order['instagram_username'] . ", DATA E DORZIMIT: " . $order['delivery_date'];
        echo "</div>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
