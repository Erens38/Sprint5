<?php
// Databaseverbinding
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['order_id'];
    $nieuweStatus = $_POST['status'];
    
    $sql = "UPDATE verkooporders SET status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nieuweStatus, $orderId);
    $stmt->execute();

    echo "Orderstatus bijgewerkt!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orderstatus Bijwerken</title>
</head>
<body>
    <h1>Orderstatus Bijwerken</h1>
    <form method="POST" action="">
        Order ID: <input type="text" name="order_id" required><br><br>
        Nieuwe status: 
        <select name="status">
            <option value="In behandeling">In behandeling</option>
            <option value="Verzonden">Verzonden</option>
            <option value="Geleverd">Geleverd</option>
            <option value="Geannuleerd">Geannuleerd</option>
        </select><br><br>
        <button type="submit">Bijwerken</button>
    </form>
</body>
</html>